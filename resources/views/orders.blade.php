@extends('layouts.app')

@section('content')
<?php
if (Auth::user() != null) {
    ?>
    <div class="container">
      <table class="table table-striped">
        <thead>
            <tr>
              <td>Horse</td>
              <td>Service</td>
              <td>Location</td>
              <td>Building</td>
              <td>Stable</td>
              <td>Employee</td>
              <td>Date</td>
              <td>Status</td>
              <td>Action</td>
            </tr>
        </thead>
        <tbody>
            @foreach($order as $or)
            <tr>
                <td>{{$or->horsename}}</td>
                <td>{{$or->servname}}</td>
                <td>{{$or->address.", ".$or->city.", ".$or->state}}</td>
                <td>{{$or->buildingname}}</td>
                <td>{{$or->stablenumber}}</td>
                <td>{{$or->firstname." ".$or->lastname}}</td>
                <td>{{$or->scheduledtime}}</td>
                <?php if ($or->status ==0){
                  $status = "Requested";
                } else if ($or->status == 1){
                  $status = "Pending";
                } else if ($or->status == 2) {
                  $status = "Complete";
                } else {
                  $status = "Rejected";
                }
                ?>
                <td>{{$status}}</td>
                <td><?php if ($or->status == 0){ ?><a href="{{action('OrderController@reviseSubmit',$or->order_id)}}" class="btn btn-primary">Edit</a></td>
              <?php } ?>
            </tr>
            @endforeach
        </tbody>
    </table>
    <br/>
    <?php
} else {
        ?>
      @include('functions.denied')
    <?php
    } ?>


<div>
@endsection
