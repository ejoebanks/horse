@extends('layouts.app')

@section('content')
<?php
if (Auth::user() != null && Auth::user()->type == 1) {
    ?>
    <div class="container">
      <table class="table table-striped">
        <thead>
            <tr>
              <td>ID</td>
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
                <td>{{$or->id}}</td>
                <td>{{$or->servname}}</td>
                <td>{{$or->employeeid}}</td>
                <td>{{$or->clientid}}</td>
                <td>{{$or->locationid}}</td>
                <td>{{$or->buildingid}}</td>
                <td>{{$or->stablenumber}}</td>

                <td><a href="{{action('OrderController@edit',$or->id)}}" class="btn btn-primary">Edit</a></td>
                <td>
                    <form action="{{action('OrderController@destroy', $or->id)}}" method="post">
                    {{csrf_field()}}
                    <input name="_method" type="hidden" value="DELETE">
                    <button class="btn btn-danger" onclick="return confirm('Are you sure?')" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <br/>
    <a href="{{ action('OrderController@create') }}" button type="submit" class="btn btn-primary">Insert New Order</button></a>
    <?php
} else {
        ?>
      @include('functions.denied')
    <?php
    } ?>


<div>
@endsection
