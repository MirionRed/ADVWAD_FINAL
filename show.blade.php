<?php
use App\Common;
?>
@extends('layouts.app')
@section('content')
  <div class="panel-body">
    <table class="table table-striped task-table">
      <thead>
        <tr>
          <th>Attribute</th>
          <th>Value</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Photo</td>
          <td>
            @if(Storage::disk('public')->exists('customer/'.$customer->id.'.jpg'))
              <img src="/storage/customer/{{$customer->id}}.jpg"
                width="240" alt="{{$customer->membership}}">
            @endif
          </td>
        </tr>
        <tr>
          <td>Membership</td>
          <td>{{$customer->membership}}</td>
        </tr>
        <tr>
          <td>Name</td>
          <td>{{$customer->name}}</td>
        </tr>
        <tr>
          <td>Address</td>
          <td>{{$customer->address}}</td>
        </tr>
        <tr>
          <td>Division</td>
          <td>
            @if(count($division)>0)
              @foreach($divison as $divisions)
                {{$divisons->name}}
              @endforeach
            @else
              No Members found
            @endif
          </td>
        </tr>
        <tr>
          <td>State</td>
          <td>{{Common::$states[$customer->membership]}}</td>
        </tr>
      </tbody>
    </table>
  </div>
@endsection

@section('content')
  <div id="customer-show" class="panel-body"></div>
  <script>
    var __props={
      url: "{{route('customer.api-show', $customer->id)}}",
    };
  </script>
@endsection
