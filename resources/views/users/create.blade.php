@extends('layouts.app')

@section('content')
<?php
if (Auth::user() != null && Auth::user()->admin == 1) {
    ?>

<div class="container">
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div><br />
@endif
<div class="container">
    <form method="post" action="{{ action('UserController@store') }}">

      <div class="form-group">
          <input type="hidden" value="{{csrf_token()}}" name="_token" />
          <label for="firstname">First Name:</label>
          <input type="text" class="form-control" name="firstname" required/>
      </div>

      <div class="form-group">
          <input type="hidden" value="{{csrf_token()}}" name="_token" />
          <label for="lastname">Last Name:</label>
          <input type="text" class="form-control" name="lastname" required/>
      </div>

        <div class="form-group">
            <input type="hidden" value="{{csrf_token()}}" name="_token" />
            <label for="address">Address:</label>
            <input type="text" class="form-control" name="address" required/>
        </div>

        <div class="form-group">
            <input type="hidden" value="{{csrf_token()}}" name="_token" />
            <label for="city">City:</label>
            <input type="text" class="form-control" name="city" required/>
        </div>

        <div class="form-group">
            <input type="hidden" value="{{csrf_token()}}" name="_token" />
            <label for="state">State:</label>
            <input type="text" class="form-control" name="state" required/>
        </div>


        <div class="form-group">
            <input type="hidden" value="{{csrf_token()}}" name="_token" />
            <label for="email">Email:</label>
            <input type="text" class="form-control" name="email" required/>
        </div>

        <div class="form-group">
            <input type="hidden" value="{{csrf_token()}}" name="_token" />
            <label for="password">Password:</label>
            <input type="password" class="form-control" name="password" required/>
        </div>

        <!--<div class="form-group">
            <input type="hidden" value="{{csrf_token()}}" name="_token" />
            <label for="admin">Admin:</label>
            <input type="text" class="form-control" name="admin" required/>
        </div>
      -->

        <div class="form-group">
          <input type="hidden" value="{{csrf_token()}}" name="_token" />
          <label for="sel1">Admin Priviliges:</label>
          <select class="form-control" id="admin" name="admin">
            <option value="1">Yes</option>
            <option value="0">No</option>
          </select>
        </div>



       <button type="submit" class="btn btn-primary">Create</button>
        </form>

    </div>
</div>
<?php
} else {
        ?>
  @include('functions.denied')
<?php
    } ?>

@endsection
