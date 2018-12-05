@extends('layouts.app')

@section('content')
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
                <label for="buildingid">Building:</label>
                  <input type="text" class="form-control" name="buildingid" />
              </div>

              <div class="form-group">
                  <input type="hidden" value="{{csrf_token()}}" name="_token" />
                  <label for="stablenumber">Stable Number:</label>
                  <input type="number" class="form-control" name="stablenumber" />
              </div>
              <div class="form-group">
                  <input type="hidden" value="{{csrf_token()}}" name="_token" />
                  <label for="scheduledtime">Scheduled Time:</label>
                  <input id="scheduledtime" name="scheduledtime" />
              </div>




              <div class="form-group">
                <input type="hidden" value="{{csrf_token()}}" name="_token"/>
                  <label for="status">Status:</label>
                      <select class="form-control" value="status" name="status" >
                            <option value="0">Requested</option>
                            <option value="1">Accepted</option>
                            <option value="2">Complete</option>
                  </select>
                </div>




        <button type="submit" class="btn btn-primary">Create</button>
        </form>


    </div>
</div>

@endsection
