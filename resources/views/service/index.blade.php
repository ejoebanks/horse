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
              <td>Name</td>
              <td>Description</td>

              <td colspan="2">Action</td>
            </tr>
        </thead>
        <tbody>
            @foreach($service as $s)
            <tr>
                <td>{{$s->id}}</td>
                <td>{{$s->servicename}}</td>
                <td>{{$s->servicedescription}}</td>

                <td><a href="{{action('ServiceController@edit',$s->id)}}" class="btn btn-primary">Edit</a></td>
                <td>
                    <form action="{{action('ServiceController@destroy', $s->id)}}" method="post">
                    {{csrf_field()}}
                    <input name="_method" type="hidden" value="DELETE">
                    <button class="btn btn-danger" onclick="return confirm('Are you sure?')" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ action('ServiceController@create') }}" button type="submit" class="btn btn-primary">Insert New Service</button></a>

<div>
  <?php
} else {
        ?>
    @include('functions.denied')
  <?php
    } ?>

@endsection
