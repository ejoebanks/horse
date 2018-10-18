@extends('layouts.app')

@section('content')
<br/>
<?php
if (Auth::user() != null && Auth::user()->type == 1) {
    ?>

<div class="container">
  <div class="row">
    <table class="table table-sm table-striped">
        <thead>
            <tr>
              <td>ID</td>
              <td>First Name</td>
              <td>Last Name</td>
              <td>Address</td>
              <td>City</td>
              <td>State</td>
              <td>Email</td>
              <td>Password</td>
              <td>Admin</td>

              <td colspan="2">Action</td>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->firstname}}</td>
                <td>{{$user->lastname}}</td>
                <td>{{$user->address}}</td>
                <td>{{$user->city}}</td>
                <td>{{$user->state}}</td>
                <td>{{$user->email}}</td>
                <td class="forcedWidth">{{$user->password}}</td>
                <td>{{$user->type}}</td>

                <td><a href="{{action('UserController@edit',$user->id)}}" class="btn btn-primary">Edit</a></td>
                <td>
                    <form action="{{action('UserController@destroy', $user->id)}}" method="post">
                      {{csrf_field()}}
                      <input name="_method" type="hidden" value="DELETE">
                      <button class="btn btn-danger" onclick="return confirm('Are you sure?')" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
  </div>
    <a href="{{ action('UserController@create') }}" button type="submit" class="btn btn-primary">Insert New User</button></a>

<div>
<?php
} else {
        ?>
  @include('functions.denied')
<?php
    } ?>


@endsection


<script>
function myFunction() {
    var txt;
    var r = confirm("Press a button!\nEither OK or Cancel.\nThe button you pressed will be displayed in the result window.");
    if (r == true) {
        txt = "You pressed OK!";
    } else {
        txt = "You pressed Cancel!";
    }
    document.getElementById("demo").innerHTML = txt;
}
</script>
