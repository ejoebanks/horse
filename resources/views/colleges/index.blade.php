@extends('layouts.app')

@section('content')
<?php
if (Auth::user() != null && Auth::user()->admin == 1) {
    ?>

<div class="container">
    <table class="table table-striped">
        <thead>
            <tr>
              <td>ID</td>
              <td>Name</td>
              <td>Address</td>
              <td>City</td>
              <td>State</td>
              <td>GPA Req</td>
              <td>Other Reqs</td>

              <td colspan="2">Action</td>
            </tr>
        </thead>
        <tbody>
            @foreach($colleges as $school)
            <tr>
                <td>{{$school->id}}</td>
                <td>{{$school->name}}</td>
                <td>{{$school->address}}</td>
                <td>{{$school->city}}</td>
                <td>{{$school->state}}</td>
                <td>{{$school->gpaReq}}</td>
                <td>{{$school->otherReqs}}</td>

                <td><a href="{{action('CollegeController@edit',$school->id)}}" class="btn btn-primary">Edit</a></td>
                <td>
                    <form action="{{action('CollegeController@destroy', $school->id)}}" method="post">
                    {{csrf_field()}}
                    <input name="_method" type="hidden" value="DELETE">
                    <button class="btn btn-danger" onclick="return confirm('Are you sure?')" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ action('CollegeController@create') }}" button type="submit" class="btn btn-primary">Insert New College</button></a>

<div>
  <?php
} else {
        ?>
    @include('functions.denied')
  <?php
    } ?>

@endsection
