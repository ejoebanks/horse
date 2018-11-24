@extends('layouts.app')

@section('content')
<div class="container">
<div class="row">
  <div class="col-md-3"></div>
  <div class="col-md-6">
    <div class="centerBlock">
      <h1 class="display-1">Order Placed</h1>
      <?php
      $ccc = \DB::table('orders')
            ->orderBy('orders.id', 'desc')
            ->where('orders.employeeid', Auth::user()->id)
            ->rightjoin('buildings', 'orders.buildingid', '=', 'buildings.id')
            ->rightjoin('locations', 'orders.locationid', '=', 'locations.id')
            ->rightjoin('services', 'orders.serviceid', '=', 'services.id')
            ->select('orders.*', 'services.servicename', 'locations.city', 'locations.state', 'locations.address', 'buildings.buildingname')
            ->first();
      $xzx = \DB::table('orders')
      ->orderBy('orders.id', 'desc')
      ->join('buildings', 'orders.buildingid', '=', 'buildings.id')
      ->join('locations', 'orders.locationid', '=', 'locations.id')
      ->join('services', 'orders.serviceid', '=', 'services.id')
      ->where('orders.employeeid', Auth::user()->id)
      ->first();

      print "<br/>";
      print "<ul style='font-size:17px;' class='list-group'>";
      print "<li class='list-group-item'>Horse Name<div class='float-right'>$ccc->horsename</div><br>";
      print "</li>";
      print "<li class='list-group-item'>Location<div class='float-right'>$ccc->address, $ccc->city, $ccc->state</div><br>";
      print "<li class='list-group-item'>Building<div class='float-right'>$ccc->buildingname</div><br>";
      print "<li class='list-group-item'>Service<div class='float-right'>$ccc->servicename</div><br>";
      print "</ul>";
      ?>
      <br/>
    <a href="{{action('OrderController@reviseReview',$ccc->id)}}" class="btn btn-outline-primary">Revise2</a></td>

    </div>
  </div>
  <div class="col-md-3"></div>
</div>
</div>
@endsection
