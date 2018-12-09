@extends('layouts.app')

@section('content')

<div class="container">
	<h2>Request an Appointment</h2>
	<br/>
  <div class="row">
    <div class="col">
    </div>
    <div class="col-md-6">
			<?= $freqAlert; ?>
			<form method="post" action="{{ action('OrderController@scheduleAppt') }}">
			  <div class="row">
			    <div class="col-md-6">
						<div class="form-group">
							<input type="hidden" value="{{csrf_token()}}" name="_token" />
							<input id="horsename" value="{{ $freqHorse }}" name="horsename" type="text" placeholder="Horse Name" class="form-control input-md" required />
					</div>
			    </div>
			    <div class="col-md-6">
						<div class="form-group">
							<input type="hidden" value="{{csrf_token()}}" name="_token" placeholder="Location"/>
							@include('functions.locations')
					</div>
			    </div>
					<div class="col-md-6">
						<div class="form-group">
							<input type="hidden" value="{{csrf_token()}}" name="_token" />
							<input id="buildingid" name="buildingid" type="text" placeholder="Building" class="form-control input-md">
					</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<input type="hidden" value="{{csrf_token()}}" name="_token" />
							<input id="stablenumber" name="stablenumber" type="number" placeholder="Stable Number" class="form-control input-md">
					</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<input type="hidden" value="{{csrf_token()}}" name="_token" />
							@include('functions.services')
					</div>
			    </div>
					<div class="col-md-6">
						<div class="form-group">
							<input type="hidden" value="{{csrf_token()}}" name="_token" />
							<input id="color" name="color" type="text" placeholder="Color" class="form-control input-md">
					</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<input type="hidden" value="{{csrf_token()}}" name="_token" />
							<select required name="tied" id="tied" class="form-control">
								<option value="">Tie Horse?</option>
								<option value="1">Yes</option>
							  <option value="0">No</option>
							</select>
					</div>
					</div>

			    <div class="col-md-6">
						<div class="form-group">
							<input type="hidden" value="{{csrf_token()}}" name="_token"/>
					    <input id="scheduledtime" name="scheduledtime" />
					</div>
			    </div>

					<div class="col-md-12">
						<div class="form-group">
							<input type="hidden" value="{{csrf_token()}}" name="_token" />
							<label class="control-label" for="comments">Comments</label>
							<textarea class="form-control" name="comments" rows="5" id="comments"></textarea>
						</div>
						<button type="submit" class="btn btn-default">Make Appointment</button>

					</div>

			  </div>
			</form>
    </div>
    <div class="col">
    </div>
  </div>
</div>

@endsection
