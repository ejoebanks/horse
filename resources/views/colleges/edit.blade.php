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
      <form class="form-horizontal" role="form" method="POST" action="{{ action('CollegeController@update',$college->id) }}">
           {!! csrf_field() !!}

           <input type="hidden" name="_method" value="PATCH">

        <div class="form-group">
            <input type="hidden" value="{{csrf_token()}}" name="_token" />
            <label for="name">Name:</label>
            <input type="text" class="form-control" name="name" value="{{ $college->name }}" />
        </div>

        <div class="form-group">
            <input type="hidden" value="{{csrf_token()}}" name="_token" />
            <label for="address">Address:</label>
            <input type="text" class="form-control" name="address" value="{{ $college->address }}" />
        </div>

        <div class="form-group">
            <input type="hidden" value="{{csrf_token()}}" name="_token" />
            <label for="city">City:</label>
            <input type="text" class="form-control" name="city" value="{{ $college->city }}" />
        </div>

        <div class="form-group">
            <input type="hidden" value="{{csrf_token()}}" name="_token" />
            <label for="address">State:</label>
            <input type="text" class="form-control" name="state" value="{{ $college->state }}" />
        </div>


          <div class="form-group">
              <input type="hidden" value="{{csrf_token()}}" name="_token" />
              <label for="gpaReq">GPA Requirement:</label>
              <input type="text" class="form-control" name="gpaReq" value="{{ $college->gpaReq }}" />
          </div>

          <div class="form-group">
              <input type="hidden" value="{{csrf_token()}}" name="_token" />
              <label for="otherReqs">Other Requirements:</label>
              <input type="text" class="form-control" name="otherReqs" value="{{ $college->otherReqs }}" />
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
