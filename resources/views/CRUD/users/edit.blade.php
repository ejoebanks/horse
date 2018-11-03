@extends('layouts.app')

@section('content')
<?php
if (Auth::user() != null && Auth::user()->type == 1) {
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
      <form class="form-horizontal" role="form" method="POST" action="{{ action('UserController@update',$user->id) }}">
           {!! csrf_field() !!}

           <input type="hidden" name="_method" value="PATCH">

        <div class="form-group">
            <input type="hidden" value="{{csrf_token()}}" name="_token" />
            <label for="firstname">First Name:</label>
            <input type="text" class="form-control" name="firstname" value="{{ $user->firstname }}" required/>
        </div>

        <div class="form-group">
            <input type="hidden" value="{{csrf_token()}}" name="_token" />
            <label for="lastname">Last Name:</label>
            <input type="text" class="form-control" name="lastname" value="{{ $user->lastname }}" required/>
        </div>


        <div class="form-group">
            <input type="hidden" value="{{csrf_token()}}" name="_token" />
            <label for="email">Email:</label>
            <input type="text" class="form-control" name="email" value="{{ $user->email }}" required/>
        </div>

        <div class="form-group">
            <input type="hidden" value="{{csrf_token()}}" name="_token" />
            <label for="address">Address:</label>
            <input type="text" class="form-control" name="address" value="{{ $user->address }}" required/>
          </div>

        <div class="form-group">
            <input type="hidden" value="{{csrf_token()}}" name="_token" />
            <label for="city">City:</label>
            <input type="text" class="form-control" name="city" value="{{ $user->city }}" required/>
          </div>

        <div class="form-group">
            <input type="hidden" value="{{csrf_token()}}" name="_token" />
            <label for="state">State:</label>
            <input type="text" class="form-control" name="state" value="{{ $user->state }}" required/>
          </div>


          <div class="form-group">
              <input type="hidden" value="{{csrf_token()}}" name="_token" />
              <label for="password">Password:</label>
              <input type="password" class="form-control" name="password" value="{{ $user->password }}" required/>
          </div>

        <!--  <div class="form-group">
              <input type="hidden" value="{{csrf_token()}}" name="_token" />
              <label for="admin">Admin:</label>
              <input type="number" class="form-control" name="admin" value="{{ $user->admin }}" required/>
          </div>
        -->

          <div class="form-group">
            <input type="hidden" value="{{csrf_token()}}" name="_token" />
            <label for="type">Admin Priviliges:</label>
            <select class="form-control" id="type" name="type">
              <option value="1">Yes</option>
              <option value="0">No</option>
            </select>
          </div>

        <button type="submit" class="btn btn-primary">Update</button>
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
