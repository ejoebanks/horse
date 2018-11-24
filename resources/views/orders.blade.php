@extends('layouts.app')

@section('content')
<?php
if (Auth::user() != null) {
    ?>
    <div class="container">
      <table class="table table-striped">
        <thead>
            <tr>
              <td>Service</td>
              <td>Employee</td>
              <td>Client</td>
              <td>Location</td>
              <td>Building</td>
              <td>Stable</td>

              <td colspan="2">Action</td>
            </tr>
        </thead>
        <tbody>
            @foreach($order as $or)
            <tr>
                <td>{{$or->servname}}</td>
                <td>{{$or->employeeid}}</td>
                <td>{{$or->clientid}}</td>
                <td>{{$or->locationid}}</td>
                <td>{{$or->buildingid}}</td>
                <td>{{$or->stablenumber}}</td>

                <td><a href="{{action('OrderController@edit',$or->order_id)}}" class="btn btn-primary">Edit</a></td>
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
