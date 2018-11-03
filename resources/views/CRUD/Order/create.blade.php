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
    <form method="post" action="{{ action('OrderController@store') }}">

<!--
        <div class="form-group">
            <input type="hidden" value="{{csrf_token()}}" name="_token"/>
            <label for="studentid">Student ID:</label>
            <input type="text" class="form-control" name="studentid" required/>
        </div>
      -->
      <div class="container">
          <div class="row">
              <div class="col-sm-6">
                  <div class="form-group">
                      <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
                          <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker1"/>
                          <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                          </div>
                      </div>
                  </div>
              </div>
              <script type="text/javascript">
                  $(function () {
                      $('#datetimepicker1').datetimepicker();
                  });
              </script>
          </div>
      </div>
        <div class="form-group">
          <input type="hidden" value="{{csrf_token()}}" name="_token"/>
            <label for="employeeid">Employee:</label>
                <select class="form-control" value="employeeid" name="employeeid" >
                  <?php
                      $users = DB::table('users')
                        ->where('users.type', '!=', '0')
                        ->distinct()
                        ->get(); ?>
                      <option value="">None</option>

                <?php foreach ($users as $uid) {
                            ?>
                      <option value="<?= $uid->id ?>"><?= $uid->firstname, " ".$uid->lastname ?></option>
                  <?php
                        } ?>
            </select>
          </div>

<!--
        <div class="form-group">
            <input type="hidden" value="{{csrf_token()}}" name="_token" />
            <label for="courseid">Course ID:</label>
            <input type="text" class="form-control" name="courseid"/>
        </div>
      -->
      <div class="form-group">
          <label for="clientid">Client:</label>
              <select class="form-control" value="clientid" name="clientid" id="clientid" required>
                <?php
                    $ZZ = DB::table('users')
                      ->where('users.type', '=', '0')
                      ->distinct()
                      ->get(); ?>
                    <option value="">None</option>

              <?php foreach ($ZZ as $client) {
                          ?>
                    <option value="<?= $client->id ?>"><?= $client->firstname. " ".$client->lastname ?></option>
                <?php
                      } ?>
          </select>
        </div>
        <div class="form-group">
            <input type="hidden" value="{{csrf_token()}}" name="_token" />
            <label for="horsename">Horse Name:</label>
            <input type="text" class="form-control" name="horsename" />
        </div>


        <div class="form-group">
          <input type="hidden" value="{{csrf_token()}}" name="_token"/>
            <label for="serviceid">Service:</label>
                <select class="form-control" value="serviceid" name="serviceid" >
                  <?php
                      $services = DB::table('services')
                        ->distinct()
                        ->get(); ?>
                      <option value="">None</option>

                <?php foreach ($services as $service) {
                            ?>
                      <option value="<?= $service->id ?>"><?= $service->servicename ?></option>
                  <?php
                        } ?>
            </select>
          </div>

          <div class="form-group">
            <input type="hidden" value="{{csrf_token()}}" name="_token"/>
              <label for="locationid">Location:</label>
                  <select class="form-control" value="locationid" name="locationid" >
                    <?php
                        $locations = DB::table('locations')
                          ->distinct()
                          ->get(); ?>
                        <option value="">None</option>

                  <?php foreach ($locations as $loc) {
                              ?>
                        <option value="<?= $loc->id ?>"><?= $loc->address.", ".$loc->city.", ".$loc->state ?></option>
                    <?php
                          } ?>
              </select>
            </div>

            <div class="form-group">
              <input type="hidden" value="{{csrf_token()}}" name="_token"/>
                <label for="buildingid">Location:</label>
                    <select class="form-control" value="buildingid" name="buildingid" >
                      <?php
                          $buildings = DB::table('buildings')
                            ->distinct()
                            ->get(); ?>
                          <option value="">None</option>

                    <?php foreach ($buildings as $bldg) {
                                ?>
                          <option value="<?= $bldg->id ?>"><?= $bldg->buildingname ?></option>
                      <?php
                            } ?>
                </select>
              </div>

              <div class="form-group">
                  <input type="hidden" value="{{csrf_token()}}" name="_token" />
                  <label for="stablenumber">Stable Number:</label>
                  <input type="number" class="form-control" name="stablenumber" />
              </div>

              <div class="form-group">
                <input type="hidden" value="{{csrf_token()}}" name="_token"/>
                  <label for="buildingid">Location:</label>
                      <select class="form-control" value="buildingid" name="buildingid" >
                            <option value="0">Requested</option>
                            <option value="1">Accepted</option>
                            <option value="2">Complete</option>
                  </select>
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
