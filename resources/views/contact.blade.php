@extends('layouts.app')

@section('content')
<div class="container">
  <h2>Contact Us</h2>

  @if(session('message'))
  <div class='alert alert-success'>
    {{ session('message') }}
  </div>
  @endif

  <div class="row">
    <div class="col">
    </div>
    <div class="col-md-6">
      <form class="form-horizontal" method="POST" action="/contact">
  			{{ csrf_field() }}
  			<div class="form-group">
  			<label for="Name">Name: </label>
  			<input type="text" class="form-control" id="name" placeholder="Your name" name="name" required>
  		</div>

  		<div class="form-group">
  			<label for="email">Email: </label>
  			<input type="text" class="form-control" id="email" placeholder="john@example.com" name="email" required>
  		</div>

  		<div class="form-group">
  			<label for="message">Message: </label>
  			<textarea type="text" rows="5" class="form-control luna-message" id="message" placeholder="Type your messages here" name="message" required></textarea>
  		</div>

  			<div class="form-group">
  				<button type="submit" class="btn btn-primary" value="Send">Send</button>
  			</div>
  		</form>
    </div>
    <div class="col">
    </div>
  </div>
</div>

<div class="container">

	<div class="col-12 col-md-6">
	</div>
 </div> <!-- /container -->
@endsection
