@extends('layouts.app')

@section('content')
<br/>
<?php
if (Auth::user() != null && Auth::user()->type == 1) {
    ?>
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-4">
        </div>


      <div class="col-sm-4">
          <a href="/services" button type="button" class="btn btn-primary btn-lg btn-block">Services</button></a>
          <a href="/bldngs" button type="button" class="btn btn-primary btn-lg btn-block">Buildings</button></a>
          <a href="/locs" button type="button" class="btn btn-primary btn-lg btn-block">Locations</button></a>
          <a href="/users" button type="button" class="btn btn-primary btn-lg btn-block">Users</button></a>
          <a href="/ords" button type="button" class="btn btn-primary btn-lg btn-block">Orders</button></a>
      </div>

      <div class="col-sm-4">
      </div>

</div>
<?php
} else {
        ?>
  @include('functions.denied')
<?php
    } ?>

@endsection
