<?php
use App\Common;
?>
@extends('layouts.app')
@section('content')
<div class="panel-body">
  <!--OPEN FORM-->
  {!!Form::model($customer, [
    'route' => ['customer.update', $customer->id],
    'class' => 'form-horizontal',
    'method' => 'PUT',
  ])!!}

    <!--TEXT-->
    <div class="form-group row">
      {!!Form::label('customer-name', 'Name', [
          'class' => 'control-label col-sm-3',
      ])!!}
      <div class="col-sm-9">
        {!!Form::text('name', $customer->name, [
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
        {!!Form::text('membership', $customer->membership, [
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
        {!!Form::textarea('address', $customer->address, [
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
        {!!Form::select('state', Common::$states, $customer->state, [
          'class' => 'form-control',
          'placeholder' => '- Select State -',
        ])!!}
      </div>
    </div>

    <!--PLUCK-->

    <!--BUTTON-->
    <div class="form-group row">
      <div class="col-sm-offset-3 col-sm-6">
        {!!Form::button('update', [
          'type' => 'submit',
          'class' => 'btn btn-primary',
        ])!!}
      </div>
    </div>
  {!!Form::close()!!}
</div>
@endsection
