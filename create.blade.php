<?php
use App\Common;
?>
@extends('layouts.app')
@section('content')
@if($errors->any())
  <div class="alert alert-danger">
    <ul>
      @foreach($errors->all() as $error)
        <li>{{$error}}</li>
      @endforeach
    </ul>
  </div>
@endif
<div class="panel-body">
  <!--OPEN FORM-->
  {!!Form::model($division, [
    'route' => ['division.store'],
    'class' => 'form-horizontal',
  ])!!}

    <!--TEXT-->
    <div class="form-group row">
      {!!Form::label('customer-name', 'Name', [
          'class' => 'control-label col-sm-3',
      ])!!}
      <div class="col-sm-9">
        {!!Form::text('name', null, [
            'id' => 'customer-name-value',
            'class' => 'form-control',
            'maxlength' => 3,
        ])!!}
      </div>
    </div>

    <div class="form-group row">
      {!!Form::label('customer-membership', 'Membership', [
          'class' => 'control-label col-sm-3',
      ])!!}
      <div class="col-sm-9">
        {!!Form::text('membership', null, [
            'id' => 'customer-membership-value',
            'class' => 'form-control',
            'maxlength' => 3,
        ])!!}
      </div>
    </div>

    <!--TEXTAREA-->
    <div class="form-group row">
      {!!Form::label('customer-address', 'Address', [
        'class' => 'control-label col-sm-3',
      ])!!}
      <div class="col-sm-9">
        {!!Form::textarea('address', null, [
          'id' => 'customer-address-value',
          'class' => 'form-control'
        ])!!}
      </div>
    </div>

    <!--SELECT-->
    <div class="form-group row">
      {!!Form::label('customer-state', 'State', [
        'class' => 'control-label col-sm-3',
      ])!!}
      <div class="col-sm-9">
        {!!Form::select('state', Common::$states, null, [
          'class' => 'form-control',
          'placeholder' => '- Select State -',
        ])!!}
      </div>
    </div>

    <!--PLUCK-->
    <div class="form-group row">
      {!!Form::label('customer-division', 'Division', [
        'class' => 'control-label col-sm-3',
      ])!!}
      <div class="col-sm-9">
        {!!Form::select('division_id', Division::pluck('name', 'id'), null, [
          'class' => 'form-control',
          'placeholder' => '- Select State -',
        ])!!}
      </div>
    </div>

    <!--RADIO-->
    <div class="form-group row">
      {!! Form::label('customer-gender', 'Gender', [
        'class' => 'control-label col-sm-3',
      ]) !!}
      <div class="col-sm-9">
        @foreach(Common::$genders as $key => $val)
          {!! Form::radio('gender', $key) !!} {{$val}}
        @endforeach
      </div>
    </div>

    <!--BUTTON-->
    <div class="form-group row">
      <div class="col-sm-offset-3 col-sm-6">
        {!!Form::button('save', [
          'type' => 'submit',
          'class' => 'btn btn-primary',
        ])!!}
      </div>
      <script>
        function onClick(){
          var url = '{{route('customer.store')}}';
          var data = {
            code: document.getElementById('customer-membership-value').value,
            name: document.getElementById('customer-name-value').value,
            address: document.getElementById('customer-address-value').value,
            state: document.getElementById('customer-state-value').value,
          };

          var status = null;
          var statusText = null;

          var metas = document.getElementsByTagName('meta');
          var csrfToken;
          for (var i=0; i<metas.length; i++) {
            if (metas[i].getAttribute("name") == "csrf-token") {
              csrfToken = metas[i].getAttribute("content");
            }
          }

          fetch(url, {
            method: 'POST',
            headers: {
              Accept: 'application/json',
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': csrfToken,
            },
            credentials: 'same-origin',
            body: JSON.stringify(data),
          })
          .then(
            response => {
              status = response.status;
              statusText = response.statusText;
              return response.json();
            }
          )
          .then(
            response => {
              if(status === 200){
                console.log(response);
              } else if (status === 422){

              } else {
                throw Error([status, statusText].join(' '));
              }
            }
          )
          .catch(error=>alert(error));
        }
      </script>
      <script>
        function onClick(){
          var url = '{{route('customer.store')}}';
          var formData = new FormData();
          var metas = document.getElementsByTagName('meta');
          var csrfToken;
          for (var i=0; i<metas.length; i++) {
            if (metas[i].getAttribute("name") == "csrf-token") {
              csrfToken = metas[i].getAttribute("content");
            }
          }
          console.log(csrfToken);
          formData.append('__token', csrfToken);
          formData.append('membership', document.getElementById('customer-membership-value').value);
          formData.append('name', document.getElementById('customer-name-value').value);
          formData.append('address', document.getElementById('customer-address-value').value);
          formData.append('state', document.getElementById('customer-state-value').value);
          console.log(formData);
          var status = null;
          var statusText = null;
          fetch(url, {
            method: 'POST',
            headers: {
              Accept: 'application/json',
              'X-CSRF-TOKEN': csrfToken,
            },
            credentials: 'same-origin',
            body: formData,
          })
          .then(
            response => {
              status = response.status;
              statusText = response.statusText;
              return response.json();
            }
          )
          .then(
            response => {
              if(status === 200){
                console.log(response);
              } else if (status === 422){

              } else {
                throw Error([status, statusText].join(' '));
              }
            }
          )
          .catch(error=>alert(error));
        }
      </script>
    </div>
  {!!Form::close()!!}
</div>
@endsection
