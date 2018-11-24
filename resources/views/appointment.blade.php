@extends('layouts.app')

@section('content')

<div class="container">
	<h2>Request an Appointment</h2>
	<br/>
  <div class="row">
    <div class="col">
    </div>
    <div class="col-md-6">
			<form method="post" action="{{ action('OrderController@scheduleAppt') }}">
			  <div class="row">
			    <div class="col-md-6">
						<div class="form-group">
							<input type="hidden" value="{{csrf_token()}}" name="_token" />
							<input id="horsename" name="horsename" type="text" placeholder="Horse Name" class="form-control input-md" required />
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
							@include('functions.buildings')
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
							<input type="hidden" value="{{csrf_token()}}" name="_token"/>
							<input id="scheduledtime" name="scheduledtime" type="text" placeholder="YYYY-MM-DD" required class="form-control input-md">
					</div>
			    </div>
					<div class="col-md-6">
						<div class="form-group">
							<input type="hidden" value="{{csrf_token()}}" name="_token" />
							<label for="employeeid">Employee:</label>
							<select class="form-control" value="employeeid" name="employeeid">
								<?php
									$users = DB::table('users')
													 ->where('users.type', '!=', '0')
													 ->distinct()
													 ->get(); ?>
								<option value="">None</option>

								<?php foreach ($users as $uid) {
																															?>
								<option value="<?= $uid->id ?>">
									<?= $uid->firstname, " ".$uid->lastname ?>
								</option>
								<?php
																													} ?>
							</select>
						</div>
					</div>

					<div class="col-md-12">
						<div class="form-group">
							<input type="hidden" value="{{csrf_token()}}" name="_token" />
							<label class="control-label" for="comments">Comments</label>
							<textarea class="form-control" rows="5" id="comments"></textarea>
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

<!--
<div class="container">
	<form method="post" action="{{ action('OrderController@scheduleAppt') }}">
			<h2>Request an Appointment</h2>
			<div class="row">
				<div class="col-md-3">
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<input type="hidden" value="{{csrf_token()}}" name="_token" />
						<label class="control-label" for="name">Horse Name</label>
						<input id="horsename" name="horsename" type="text" placeholder="Horse Name" class="form-control input-md">
					</div>
				</div>

				<div class="col-md-3">
					<div class="form-group">
						<input type="hidden" value="{{csrf_token()}}" name="_token" />
						<label class="control-label" for="stablenumber">Stable Number:</label>
						<input id="stablenumber" name="stablenumber" type="number" placeholder="" class="form-control input-md">
					</div>
				</div>

				<div class="col-md-6">
					<div class="form-group">
						<input type="hidden" value="{{csrf_token()}}" name="_token" />
						<label class="control-label" for="locationid">Location</label>
						@include('functions.locations')
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<input type="hidden" value="{{csrf_token()}}" name="_token" />
						<label class="control-label" for="buildingid">Buildings</label>
						@include('functions.buildings')
					</div>
				</div>

				<div class="col-md-6">
					<div class="form-group">
						<input type="hidden" value="{{csrf_token()}}" name="_token" />
						<label class="control-label" for="scheduledtime">Date</label>
						<input id="scheduledtime" name="scheduledtime" type="text" placeholder="Date" class="form-control input-md">
					</div>
				</div>

				<div class="col-md-6">
					<div class="form-group">
						<input type="hidden" value="{{csrf_token()}}" name="_token" />
						<label class="control-label" for="serviceid">Service</label>
						@include('functions.services')
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<input type="hidden" value="{{csrf_token()}}" name="_token" />
						<label for="employeeid">Employee:</label>
						<select class="form-control" value="employeeid" name="employeeid">
							<?php
                                                    $users = DB::table('users')
                                                        ->where('users.type', '!=', '0')
                                                        ->distinct()
                                                        ->get(); ?>
							<option value="">None</option>

							<?php foreach ($users as $uid) {
                                                            ?>
							<option value="<?= $uid->id ?>">
								<?= $uid->firstname, " ".$uid->lastname ?>
							</option>
							<?php
                                                        } ?>
						</select>
					</div>
				</div>


				<div class="col-md-12">
					<div class="form-group">
						<input type="hidden" value="{{csrf_token()}}" name="_token" />
						<label class="control-label" for="comments">Comments</label>
						<textarea class="form-control" rows="5" id="comments"></textarea>
					</div>
				</div>

			</div>
			<button type="submit" class="btn btn-default">Make Appointment</button>
</div>
</form>
</div>
-->
@endsection
