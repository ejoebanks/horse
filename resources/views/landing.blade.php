@extends('layouts.app')

@section('content')
<style>
.pt-4,.py-4{padding-top:0rem !important}
</style>
<header class="business-header">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
      </div>
    </div>
  </div>
</header>

<!-- Page Content -->
<div class="container">

  <div class="row">
    <div class="col-sm-8">
      <h2 class="mt-4">What We Do</h2>
      <p>At IHBO, Illinois Horse Braiding Online, we are a team of horse braiders that will prepare your horse for shows and other events.  We offer various styles of braiding, requests, and more.  We work in locations across the midwest. </p>
      <p>This website allows you to schedule an appointment for your horse(s), view and revise your requested appointments, and get into contact with your horse braider.</p>
      <p>
        <a class="btn btn-primary btn-lg" href="/schedule">Schedule Appointment &raquo;</a>
      </p>
    </div>
    <div class="col-sm-4">
      <h2 class="mt-4">Contact Us</h2>
      <address>
        <strong>Kim Pevonka</strong>
        <br>123 Address Here
        <br>City, State 11111
        <br>
      </address>
      <address>
        <abbr title="Phone">P:</abbr>
        (123) 456-7890
        <br>
        <abbr title="Email">E:</abbr>
        <a href="mailto:#">name@example.com</a>
      </address>
    </div>
  </div>
  <!-- /.row -->

  <div class="row">
    <div class="col-sm-4 my-4">
      <div class="card">
        <img class="card-img-top" src="{{ asset('images/information.png') }}" alt="">
        <div class="card-body">
          <h4 class="card-title">Schedule</h4>
          <p class="card-text">If you're interested in making an appointment, take a look at my schedule to see what is open.</p>
        </div>
        <div class="card-footer">
          <a href="/calendar" class="btn btn-primary">View</a>
        </div>
      </div>
    </div>
    <div class="col-sm-4 my-4">
      <div class="card">
        <img class="card-img-top" src="{{ asset('images/gallery.png') }}" alt="">
        <div class="card-body">
          <h4 class="card-title">Gallery</h4>
          <p class="card-text">Take a look at our gallery, which displays some of our work from our many clients.</p>
        </div>
        <div class="card-footer">
          <a href="/gallery" class="btn btn-primary">View</a>
        </div>
      </div>
    </div>
    <div class="col-sm-4 my-4">
      <div class="card">
        <img class="card-img-top" src="{{ asset('images/contact.png') }}" alt="">
        <div class="card-body">
          <h4 class="card-title">Contact Us</h4>
          <p class="card-text">If you're having issues booking an appointment, have a special request, or need to get into contact, send us an e-mail.</p>
        </div>
        <div class="card-footer">
          <a href="/contact" class="btn btn-primary">Contact</a>
        </div>
      </div>
    </div>

  </div>
  <!-- /.row -->

</div>

@endsection
