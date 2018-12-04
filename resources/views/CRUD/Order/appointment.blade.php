@extends('layouts.app')

@section('content')
    <div class="container">
      <div class="row">
  <div class="col-sm-3"></div>
  <div class="col-sm-6">
      <table class="table table-striped">
        <thead>
            <tr>
            </tr>
        </thead>
        <tbody>
            @foreach($order as $or)
            <tr>
              <table class="table table-striped">
                <tbody>
                      <th>Client Name</th>
                        <td>{{$or->firstname}} {{ $or->lastname}}</td>
                    </tr>
                    <tr>
                      <th>Horse Name</th>
                        <td>{{ $or->horsename }}</td>
                    </tr>

                    <tr>
                      <th>Service Name</th>
                        <td>{{ $or->servname }}</td>
                    </tr>
                  <tr>
                      <th>Location</th>
                        <td>{{$or->address}}, {{ $or->city}}, {{$or->state}} </td>
                    </tr>
                    <tr>
                        <th>Building</th>
                          <td>{{ $or->buildingid}}</td>
                      </tr>
                      <tr>
                        <th>Stable Number</th>
                          <td>{{ $or->stablenumber }}</td>
                      </tr>

                      <tr>
                        <th>Requested Date</th>
                        <td>{{ $or->scheduledtime }}</td>
                      </tr>
                      <tr>
                        <th>Comments</th>
                          <td>{{ $or->comments }}</td>
                      </tr>
                </tbody>
              </table>
            </tr>
            @endforeach
        </tbody>
    </table>
    <td><a href="{{action('OrderController@edit',$or->order_id)}}" class="btn btn-primary">Edit</a></td>
  </div>
  <div class="col-sm-3"></div>
</div>

    <br/>

<div>
@endsection
