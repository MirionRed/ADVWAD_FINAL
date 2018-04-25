<?php
use App\Common;
?>
@extends('layouts.app')
@section('content')
  <h3>Upload Photo</h3>
  <h4>Membership: <em>{{$customer->membership}}</em></h4>
  <h4>Customer Name: <em>{{$customer->name}}</em></h4>
  <div class="panel-body">
    @if($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach($errors->all() as $error)
            <li>{{$error}}</li>
          @endforeach
        </ul>
      </div>
    @endif
    {!! Form::open([
        'route' => ['customer.saveUpload', $customer->id],
        'class' => 'form-horizontal',
        'enctype' => 'multipart/form-data',
      ])!!}

      <div class="form-group row">
        {!! Form::label('customer-photo', 'Select File', [
            'class' => 'control-label col-sm-3',
          ])!!}
        <div class="col-sm-9">
          {!!Form::file('image', [
              'id' => 'customer-photo-file',
              'class' => 'form-control',
            ])!!}
        </div>
      </div>

      <div class="form-group row">
        <div class="col-sm-offset-3 col-sm-6">
          {!! Form::button('Upload', [
            'type' => 'submit',
            'class' => 'btn btn-primary',
            ])!!}
          </div>
        </div>
        {!!Form::close()!!}
      </div>
    @endsection
