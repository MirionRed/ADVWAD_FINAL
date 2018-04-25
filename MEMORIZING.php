<?php
class controller extends controller{

  public function __construct(){
    $this->middleware('auth');
  }
  public function create(){
    $customer = new Customer();
    return view('customer.create', [
      'customer' => $customer,
    ]);
  }
  public function store(Request $request){
    $customer = new Customer;
    $customer->fill($request->all());
    $customer->save();
    return redirect()->route('customer.index');
  }

  public function index(){
    $customers = Customer::orderBy('name', 'asc')->get();
    return view('customer.index', [
      'customer' => $customers,
    ])
  }
  public function show($id){
    $customer = Customer::find($id);
    return view('customer.view', [
      'customer' => $customer
    ])
  }

  public function edit($id){
    $customer = Customer::find($id);
    return view('customer.edit', [
      'customer' => $customer,
    ])
  }
  public function update(Request $request, $id){
    $customer = Customer::find($id);
    $customer->fill($request->all());
    $customer->save();
    return redirect()->route('customer.index');
  }

  public function addGroup($id){
    $customer = Customer:find($id);
    $division = $customer->division()->get();
    $divisionId = array();
    foreach($division as $division){
      $divisionId = $divison->id;
    }
    return view('member.addGroup', [
      'customer' => $customer,
      'division' => $division,
      'allDivision' => Division::orderBy('name', 'asc')->get(),
    ])
  }
  public function saveAddGorup(Request $request, $id){
    $customer = Custoemr::find($id);
    $customer->groups()->sync($request->input('group_id'))
  }

  public function destroy($id){
    $customer = Customer::find($id);
    $customer->delete();
    return redirect()->route('customer.index');
  }

  public function index(Request $request){
    $customer = Customer::with('division::id,code,name')
      ->when($request->query('membership'), function($query) use ($reqeust){
        return $query->where('membership', $request->query('membership'));
      })
      ->when($request->query('name'), function($query) use ($request){
        return $query->where('name', 'like', '%'.$request->query('name').'%');
      })
  }


  public function saveFile(Request $request, $id){
    $customer = Customer::find($id);
    $file = $request->file('iimage');
    $path = $file->storeAs('public/member'.$id.'.jpg')
  }


}
Route::resource('/customer', 'CustomerController', [
  'except' => [
    'destroy'
  ]
])->middleware('auth');
Route::get('/customer/create', 'CustomerController@create')->name('custoemr.create')

public function addMember(Request $request, $id){
  $custoemr = Custoemr::find($id);
  $customer->member()->sync($request->input('member_id'))
}

public funciton addMember($id){
  $customer = Custoemr::find($id)
  $division = Division::orderBy('name', 'asc')->get();
  $customerDivision = $customer->dvision()->get();
  $divisionId = array();
  foreach($customerDivison as $dvisionid){
    $divisonId[] = $divisonid->id;
  }
}
