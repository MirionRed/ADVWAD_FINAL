<?php
use App\Common;
use App\Customer;
?>
<section class="filters">
  {!!Form::open([
      'route' => ['customer.index'],
      'method' => 'get',
      'class' => 'form-inline'
  ])!!}
    {!!Form::label('customer-membership', 'Membership', [
        'class' => 'control-label col-sm-9',
    ])!!}
    {!!Form::text('membership', null, [
        'id' => 'customer-membership',
        'class' => 'form-control col-sm-9',
        'maxlength' => 3,
    ])!!}
    {!!Form::label('customer-name', 'Name', [
        'class' => 'control-label col-sm-9',
    ])!!}
    {!!Form::text('name', null, [
        'id' => 'customer-name',
        'class' => 'form-control',
        'maxlength' => 100,
    ])!!}
    {!! Form::label('customer-state', 'State', [
      'class' => 'control-label col-sm-3',
    ]) !!}
    {!! Form::select('state', Common::$states, null, [
      'class' => 'form-control',
      'placeholder' => '- Select State -',
    ]) !!}
    {!!Form::button('Filter', [
        'type' => 'submit',
        'class' => 'btn btn-primary',
    ])!!}
  {!!Form::close()!!}
  </div>
</section>
