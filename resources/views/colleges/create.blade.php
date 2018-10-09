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
    <form method="post" action="{{ action('CollegeController@store') }}">
      <div class="form-group">
          <input type="hidden" value="{{csrf_token()}}" name="_token" />
          <label for="name">Name:</label>
          <input type="text" class="form-control" name="name" />
      </div>

      <div class="form-group">
          <input type="hidden" value="{{csrf_token()}}" name="_token" />
          <label for="address">Address:</label>
          <input type="text" class="form-control" name="address" />
      </div>

      <div class="form-group">
          <input type="hidden" value="{{csrf_token()}}" name="_token" />
          <label for="city">City:</label>
          <input type="text" class="form-control" name="city" />
      </div>

      <div class="form-group">
          <input type="hidden" value="{{csrf_token()}}" name="_token" />
          <label for="state">State:</label>
          <input type="text" class="form-control" name="state" />
      </div>


        <div class="form-group">
            <input type="hidden" value="{{csrf_token()}}" name="_token" />
            <label for="gpaReq">GPA Requirement:</label>
            <input type="text" class="form-control" name="gpaReq" />
        </div>

        <div class="form-group">
            <input type="hidden" value="{{csrf_token()}}" name="_token" />
            <label for="otherReqs">Other Requirements:</label>
            <input type="text" class="form-control" name="otherReqs" />
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
