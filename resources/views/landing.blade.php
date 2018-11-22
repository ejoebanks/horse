@extends('layouts.app')

@section('content')
<style>
.pt-4,.py-4{padding-top:0rem !important}
</style>
<header class="business-header">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <h1 class="display-3 text-center text-white mt-4">Horse Braiding</h1>
      </div>
    </div>
  </div>
</header>

<!-- Page Content -->
<div class="container">

  <div class="row">
    <div class="col-sm-8">
      <h2 class="mt-4">What We Do</h2>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A deserunt neque tempore recusandae animi soluta quasi? Asperiores rem dolore eaque vel, porro, soluta unde debitis aliquam laboriosam. Repellat explicabo, maiores!</p>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis optio neque consectetur consequatur magni in nisi, natus beatae quidem quam odit commodi ducimus totam eum, alias, adipisci nesciunt voluptate. Voluptatum.</p>
      <p>
        <a class="btn btn-primary btn-lg" href="/schedule">Schedule Appointment &raquo;</a>
      </p>
    </div>
    <div class="col-sm-4">
      <h2 class="mt-4">Contact Us</h2>
      <address>
        <strong>Customer Name</strong>
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
          <h4 class="card-title">About Us</h4>
          <p class="card-text">You may know what we do from the above description, but click below to find out more about us directly.</p>
        </div>
        <div class="card-footer">
          <a href="#" class="btn btn-primary">Learn More</a>
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
          <a href="#" class="btn btn-primary">View</a>
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
          <a href="#" class="btn btn-primary">Contact</a>
        </div>
      </div>
    </div>

  </div>
  <!-- /.row -->

</div>

@endsection
