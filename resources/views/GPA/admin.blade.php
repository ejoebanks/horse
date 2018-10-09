@extends('layouts.app')

@section('content')
<?php
if (Auth::user() != null && Auth::user()->admin == 1) {
    ?>
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-4">
          <a href="/users" button type="button" class="btn btn-primary btn-lg btn-block">Students</button></a>
        </div>

      <div class="col-sm-4">
          <a href="/courses" button type="button" class="btn btn-primary btn-lg btn-block">Courses</button></a>
          <a href="/grade" button type="button" class="btn btn-primary btn-lg btn-block">Grades</button></a>

      </div>

      <div class="col-sm-4">
          <a href="/colleges" button type="button" class="btn btn-primary btn-lg btn-block">Colleges</button></a>
      </div>
</div>
<?php
} else {
        ?>
  @include('functions.denied')
<?php
    } ?>

@endsection
