<?php use App\common; ?>
@extends('layouts.app');
@section('contents')
  {!!Form::model($customer, [
    'route' => 'customer.store',
  ])!!}

  {!!Form::label('customer-membership', 'Membership')!!}
  {!!Form::text('membership', $customer->membership)!!}

  {!!Form::label('customer-address', 'Address')!!}
  {!!Form::textarea('address', $customer->address)!!}

  {!!Form::select('gender', Commons::$state, $customer->gender)!!}

  {!!Form::select('division_id', Division::pluck('name', 'id'), null)!!}

  @foreach(Common::$gender as $key => $val)
    {!!Form::radio('gender', $key)!!}{{$val}}
  @endforeach

  {!!Form::button('save', [
    'type' => 'submit'
  ])!!}
@endsection

@extends('layouts.app')
@section('content')
  <table>
    <thead>
      <tr>
        <th>Attribute</th>
        <th>Value</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Membership</td>
        <td>{{$customer->membership}}</td>
      </tr>
      <tr>
        <td>Name</td>
        <td>{{$customer->name}}</td>
      </tr>
      <tr>
        <td>State</td>
        <td>{{Common::$state[$customer->state]}}</td>
      </tr>
      <tr>
        <td>Divisoin</td>
        <td>
          @if(count($division)>0)
            @foreach($divison as $divisions)
              {{$divisions->name}},
            @endforeach
          @else
            No membership
          @endif
        </td>
      </tr>
    </tbody>
  </table>
@endsection

@section('content')
  <div id="customer-show"></div>
  <script>
    var __props ={
      url: "{{route('member.api-show', $customer->id)}}"
    }
  </script>
@endsection

@section('content')
  @if((count($customer)>0))
  <table>
    <thead>
      <tr>
        <th></th>
      </tr>
    </thead>
    <tbody>
      @foreach($customers as $i => $customers)
      <tr>
        <td>{{i + 1}}</td>
        <td>{{$customer->name}}</td>
        <td>
          {!!link_to_route('member.show',
            $title = $member->memberhisp,
            $paramenters = [
              'id' => $member->id,
              ])!!}
        </td>
        <td>
          {!!Form::checkbox('group_id[]', $group->id, (in_array($group->id, $groupid)? true: false)
            )!!}
        </td>
      </tr>
    @endforeach
    {{$member->link()}}
    </tbody>
  </table>
  @else
  <div>
    No Record
  </div>
  @endif
@endsection
@include('custoemr.__filetr')

<section>
  {!!Form::open([
    'route' => 'member.index'
    ])!!}
  {!!Form::close()!!}
</section>

<script>
  function onClick(){
    var url = {{route('customer.crate')}};
    var data = {
      code: document.getElementById('customer-value').value,
    };
    var status = null
    var statusText = null
    fetch(url, {
      method: 'POST'
      headers: {
        Accept: 'applicaiton/json',
        'Content-Type': 'applicaiton/json',
        'X-CSRF-CONTENT': csrf,
      }
      credentials: 'same-origini',
      body: JSON.stringify(data),
    })
    .then(respose=>{
      status = response.status;
      statusText = response.statusText;
      return response.json();
    })
    .then(customer=>{
      console.log(customer)
    })
    .catch(error=>alert(error))
  }

  function onClick(){
    var url = '{{route('customer.store')}}'
    var formData = new FormData();
    formData.append('__token', csrf);
    formData.append('membership', document.getElementById('membership'.value));

    var status = null;
    var statusText = null;

    fetch(url, {
      methos: 'POST',
      headers: {
        Accept: 'application/json',
        'Content-Type': 'applicaiton/json',
        'X-CSRF-TOKEN': csrf,
      }
      credentials: 'same-origin',
      body: formData,
    })
    .then(reponse=>{
      status = response.status;
      statusText = resposne.statusText;
      return response.json();
    })
    .then(customer=>{

    })
  }
</script>

{!!Form::checkbox('member_id[]', $division->id, in_array($diviison->id, $divison_id)? true:false)!!}


{!!Form::file('image', null)!!}

@if(Storage::disk('public')->exists('/customer'.$customer->id.'.jpg'))
  <img src="/storage/customer/{{$customer->id}}.jpg">
@endif
