<?php
use App\Common;
?>
@extends('layouts.app')
@section('content')
@include('customers._filters')
  <div class="panel-body">
    @if(count($customer)>0)
      <table class="table table-stripped task-table">
        <thead>
          <tr>
            <th>No.</th>
            <th>Name</th>
            <th>Membership</th>
            <th>Address</th>
            <th>State</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach($customer as $i=>$customerNo)
            <tr>
              <td>
                <div>{{$i + 1}}</div>
              </td>
              <td>
                <div>
                  {!!link_to_route(
                    'division.show',
                    $title = $customerNo->membership,
                    $parameters = [
                      'id' => $customerNo->id,
                    ]
                  )!!}
                </div>
              </td>
              <td>
                <div>{{$customerNo->name}}</div>
              </td>
              <td>
                <div>{{$customerNo->address}}</div>
              </td>
              <td>
                <div>{{Common::$states[$customerNo->state]}}</div>
              </td>
              <td>
                <div>
                  {!!link_to_route(
                    'customer.edit',
                    $title = 'Edit',
                    $parameters = [
                      'id' => $customerNo->id,
                    ]
                  )!!},
                  {!!link_to_route(
                    'customer.upload',
                    $title = 'Upload',
                    $parameters = [
                      'id' => $customerNo->id,
                    ]
                  )!!}
                </div>
              </td>
            </tr>
          @endforeach
          {{-- $members->links() --}}
        </tbody>
      </table>
      {{ $customer->links() }}
    @else
      <div>
        No records found
      </div>
    @endif
  </div>
@endsection

@section('content')
  <div id="division-index" class="panel-body"></div>
  <script>
    var __props = {
      url: "{{route('customer.api-index')}}",
    };
  </script>
@endsection
