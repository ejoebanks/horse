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
      <form class="form-horizontal" role="form" method="POST" action="{{ action('OrderController@update',$order->id) }}">
           {!! csrf_field() !!}
           <?php echo $order;
           exit; ?>

           <input type="hidden" name="_method" value="PATCH">

        <div class="form-group">
            <label for="serviceid">Service:</label>
                <select class="form-control" value="serviceid" name="serviceid" id="serviceid">
                      <option value="{{ $order->serviceid }}">{{ $order->servname }}</option>
                    <?php  $srvcs = \DB::table('services')
                                  ->select('services.*')
                                  ->get();?>

                  <?php foreach ($srvcs as $uid) {
                              ?>
                        <option value="<?= $uid->id ?>"><?= $uid->servicename ?></option>
                    <?php
                          } ?>

            </select>
          </div>
          <div class="form-group">
              <label for="employeeid">Employee:</label>
                  <select class="form-control" value="employeeid" name="employeeid" id="employeeid">
              </select>
            </div>
            <div class="form-group">
                <label for="clientid">Client:</label>
                    <select class="form-control" value="clientid" name="clientid" id="clientid">
                </select>
              </div>
              <div class="form-group">
                  <label for="locationid">Location:</label>
                      <select class="form-control" value="locationid" name="locationid" id="locationid">
                  </select>
                </div>

                <div class="form-group">
                    <label for="buildingid">Building:</label>
                        <select class="form-control" value="buildingid" name="buildingid" id="buildingid">
                    </select>
                  </div>
                  <div class="form-group">
                      <label for="stablenumber">Stable:</label>
                          <select class="form-control" value="stablenumber" name="stablenumber" id="stablenumber">
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
