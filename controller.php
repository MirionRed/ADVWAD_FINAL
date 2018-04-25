<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerController extends Controller{
  public function create(){
    $customer = new Customer();
    return view('customer.create', [
      'customer' => $customer;
    ])
  }
  public function store(Request $request){
    $customer = new Customer;
    $customer->fill($customer->all());
    $customer->save();
    return redirect()->route('customer.index');

    //JSON RESPONSE
    $success = $customer->save();
    return response()->json([
      'success' => $success,
      'customer' => $customer,
    ]);
  }

  public function index(){
    $customer = Customer::orderBy('name', 'asc')->get();
    return view('customer.index', [
      'customer' => $customer,
    ])
  }
  public function show($id){
    $customer = Customer::find($id);
    if(!$customer) throw new ModelNotFoundException;
    return view('customer.show',[
      'customer' => $customer,
    ]);
  }

  public function edit($id){
    $customer = Customer::find($id);
    if(!$customer) throw new ModelNotFoundException;
    return view('customer.edit', [
      'customer' => $customer,
    ]);
  }
  public function update(Request $request, $id){
    $customer = Customer::find($di);
    if(!$customer) throw new ModelNotFoundException;
    $customer->fill($request->all());
    $customer->save();
    return redirect()->route('customer.index');
  }

  public function destroy($id){
    $customer = Customer::find($id);
    $customer->delete();
    return redirect()->route('customer.index');
  }

  //EXTRA INSERTING & UPDATING
  public function save(Request $request, $id){
    $customer = Customer::find($id);
    $division = Division::find($id);

    $customer->division()->save($division);
    $customer->division()->saveMany([
      new Division([
        'name' => 'value', ]),
      new Division([
        'name' => 'value', ]),
    ]);
  }

  public function create(Request $request, $id){
    $customer = Customer::find($id);
    $division = Division::find($id);

    $customer->division()->create($division);
    $customer->division()->createMany([
      new Division([
        'name' => 'value', ]),
      new Division([
        'name' => 'value', ]),
    ]);
  }

  //BELONGS TO
  public function associateANDdissociate(Request $request, $id){
    $customer = Customer::find($id);
    $division = Division::find($id);

    $customer->division()->associate($division);
    $customer->save();

    $customer->division()->dissociate();
    $customer->save();
  }

  //MANY TO MANY
  public function attachANDdetach(Request $request, $id){
    $customer = Customer::find($id);
    $division = Division::find($id);

    $customer->division()->attach($division);
    $customer->save();

    $customer->division()->detach();
    $customer->save();

    $customer->division()->attach($division_id, ['name' => 'value']);
  }

  public function sync(Request $request, $id){
    $customer = Customer::find($id);
    $division = Division::find($id);

    $customer->division()->sync($division, $division, $division);
    $customer->division()->sync([
      25 => ['name' => '201801'],
      25 => ['name' => '201801'],
    ]);

    $customer->division()->syncWithoutDetaching($division, $division, $division);
  }

  public function toggle(Request $request, $id){
    $customer = Customer::find($id);
    $division = Division::find($id);

    $customer->division()->toggle($division, $division, $division);
  }

  public function updatePivot(Request $request, $id){
    $customer = Customer::find($id);
    $customer->division()->updateExistingPivot($division_id, [
      'name' => 'value2',
    ]);
  }

  //QUERYING RELATIONS
  public function where(Request $request, $id){
    $customer = Customer::find($id);
    $division = $customer->division()->where('name', 'value')->get();
    $division = $customer->division()->get();

    $customer = Customer::has('division')->get();
    $customer = Customer::has('division', '>=', 3)->get();

    $customer = Customer::whereHas('division', function($query){
      $query->where('name', 'like', '%li%');
    });

    $customer = Customer::doesntHave('division')->get();
    $customer = Customer::withCount('division')->get();
    foreach($customers as $customer) {
      var_dump($customer->customer_count);
    }
    $customer = Customer::withCount([
      'divisions',
      'division as type count' => function($query){
        $query->where('type', 'F');
      }
    ])->get();
    foreach($customers as $customer){
      var_dump($customer->name);
      var_dump($customer->division_count);
      var_dump($customer->type_count);
    }
  }

  //EAGER LOADING
  public function with(){
    $customers = Customer::with(['division', 'groups'])->get();
    $customers = Customer::with('division.department')->get();
    $customers = Customer::with('division:id,code,name')->get();
    $customers = Customer::with(['division' => function($query){
      $query->where('name', 'like', '%ace%');
    }])->get
    $customers = Customer::with(['division' => function($query){
      $query->orderBy('name', 'desc');
    }])->get();
  }

  //PAGINATION
  public function pagination(){
    $customers = Customer::paginate(10);
    $customers = Customer::orderBy('name', 'asc')->paginate(5);
    $customers = Customer::orderBy('name', 'asc')->simplePaginate(5);
  }

  //QUERY BUILDER
  public function index(Request $request){
    $customer = Customer::with('division:id,code,name')
      ->when($request->query('membership'), function($query) use ($request){
        return $query->where('membership', $request->query('membership'));
      })
      ->when($request->query('name'), function($query) use ($request){
        return $query->where('name', 'like', '%'.$request->query('name').'%');
      })
      ->when($request->query('state'), function($query) use ($request){
        return $query->where('state', $request->query('state'));
      })
      ->paginate(20);
    return view('customer.index', [
      'customer' => $customer,
      'request' => $request,
    ]);
  }

  //QUERYING RELATIONS
  public function show(Request $request){
    $customer = Customer::find($id);
    if(!$customer) throw new ModelNotFoundException;

    $customerDivision = $customer->division()->get();
    return view('divisions.show', [
      'customer' => $customer,
      'division' => $customerDivision,
    ]);
  }

  //VALIDATION
  public function store(FormRequest $request){
    $request->validate([
      'membership' => [
        'required',
        'unique:customers',
        'regex:/ˆ([A-Z]{3})([0-9]{7})$/'
        new Rules,
      ],
      'name' => 'required|max:100',
      'address' => 'required|max:500',
      'state' => 'required',
      //OTHERS
      'postcode' => [
        'required',
        'regex:/ˆ([0-9]{2,3})\-([0-9]{6,8})$/',
      ],
      'division_id' => 'required',
    ]);
    $customer = new Customer;
    $customer->fill($request->all());
    $customer->save();
    return redirect()->route('member.index');
  }

  //UPLOAD FILE
  public function upload($id){
    $customer = Customer::find($id);
    if(!$customer) throw new ModelNotFoundException;
    return view ('customer.upload', [
      'customer' => $customer,
    ]);
  }
  public function saveUpload(UploadFormRequest $request, $id){
    $file = $request->file('image');
    $path = $file->storeAs('public/customer', $id.'.jpg');
    return redirect()->route('customer.index');
  }

  //PROTECTING ROUTES
  public function __construct(){
    $this->middleware('auth');
  }
  use HasRolesAndAbilities;//ONLY USED FOR BOUNCER MAYBE

  public function checkUserAuthorization($user, $post){
    if(Gate::allows('update-post', $post)){
      return 'ALLOWED';
    } else {
      return 'DENIED';
    }
    if(Gate::denies('update-post', $post)){
      return 'DENIED';
    } else {
      return 'ALLOWED';
    }

    if(Gate::forUser($user)->allows('update-post', $post)){

    }
    if(Gate::forUser($user)->denies('update-post', $post)){

    }

    //FROM OTHER SITE
    if(Gate::allows('update-post', auth()->user())){
      return view('customer.index');
    }
  }

  //IMPLEMENT POLICY IN CONTROLLER METHOD
  //MIGHT BE IN POLICY CLASS
  public function create(){
    if($user->can('update', $post)){

    }
    if($user->can('create', Post::class)){

    }
  }

  //AUTHORIZING IN CONTROLLER
  public function update(Request $request, Post $post){
    $this->authorize('update', $post);
  }
  public function update(Request $request){
    $this->authorize('update', Post::class);
  }

  //REACT
  public function apiShow($id){
    $customer = Customer::find($id);
    if($customer){
      return $customer;
    }else{
      return response()->json(null);
    }
  }
  public function apiIndex(){
    $customer = Customer::orderBy('name', 'asc')->get();
    return $customer;
  }
}
