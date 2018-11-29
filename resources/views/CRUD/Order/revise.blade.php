@extends('layouts.app')

@section('content')
<?php
if (Auth::user() != null && Auth::user()->id == $order->clientid) {
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
      <form class="form-horizontal" role="form" method="POST" action="{{ action('OrderController@reviseSubmit',$order->id) }}">
           {!! csrf_field() !!}
           <input type="hidden" name="_method" value="POST">
           <div class="form-group">
               <input type="hidden" value="{{csrf_token()}}" name="_token" />
               <label for="horsename">Horse Name:</label>
               <input type="text" class="form-control" name="horsename" value="{{ $order->horsename }}" />
           </div>

        <div class="form-group">
            <label for="serviceid">Service:</label>
                <select class="form-control" value='{{ $order->servname }}' name="serviceid" id="serviceid">
                      <option value="{{ $order->serviceid }}">{{ $order->servname }}</option>
                    <?php  $services = \DB::table('services')
                                  ->select('services.*')
                                  ->get(); ?>
                  <?php
                  $selected = "";
    foreach ($services as $service) {
        if ($service->id == $order->serviceid) {
            $selected = "selected";
        } else {
            $selected = "";
        } ?>
                        <option {{ $selected }} value="<?= $service->id ?>"><?= $service->servicename ?></option>
                    <?php
    } ?>

            </select>
          </div>

              <div class="form-group">
                  <label for="locationid">Location:</label>
                  <select class="form-control" value="locationid" name="locationid" >
                    <?php
                        $locations = DB::table('locations')
                          ->distinct()
                          ->get(); ?>
                        <option value="">None</option>

                  <?php foreach ($locations as $loc) {
                              if ($loc->id == $order->locationid) {
                                  $selected = "selected";
                              } else {
                                  $selected = "";
                              } ?>
                        <option {{ $selected }} value="<?= $loc->id ?>"><?= $loc->address.", ".$loc->city.", ".$loc->state ?></option>
                    <?php
                          } ?>
              </select>
            </div>

                <div class="form-group">
                    <label for="buildingid">Building:</label>
                    <select class="form-control" value="buildingid" name="buildingid" >
                      <?php
                          $buildings = DB::table('buildings')
                            ->distinct()
                            ->get(); ?>

                    <?php foreach ($buildings as $bldg) {
                                if ($bldg->id == $order->buildingid) {
                                    $selected = "selected";
                                } else {
                                    $selected = "";
                                } ?>
                          <option {{ $selected }} value="<?= $bldg->id ?>"><?= $bldg->buildingname ?></option>
                      <?php
                            } ?>
                </select>
              </div>
                  <div class="form-group">
                      <label for="stablenumber">Stable:</label>
                          <input class="form-control" value="{{ $order->stablenumber }}" name="stablenumber" id="stablenumber">
                      </select>
                    </div>
                    <div class="form-group">
                        <label for="scheduledtime">Scheduled Time:</label>
                            <input class="form-control" value="{{ $order->scheduledtime }}" name="scheduledtime" id="scheduledtime">
                        </select>
                      </div>
                      <div class="form-group">
                          <label for="comments">Comments:</label>
                              <input class="form-control" value="{{ $order->comments }}" name="comments" id="comments">
                          </select>
                        </div>

        <button type="submit" class="btn btn-primary">Update</button>
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
