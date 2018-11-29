@extends('layouts.app')

@section('content')
<?php
if (Auth::user() != null && Auth::user()->id == $ccc->clientid) {
?>
<div class="container">
<div class="row">
  <div class="col-md-3"></div>
  <div class="col-md-6">
    <div class="centerBlock">
      <h1 class="display-1">Order Placed</h1>
      <?php
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
    <a href="{{action('OrderController@reviseReview',$ccc->id)}}" class="btn btn-outline-primary">Revise</a></td>

    </div>
  </div>
  <div class="col-md-3"></div>
</div>
<?php
} else {
    ?>
  @include('functions.denied')
<?php
} ?>

</div>
@endsection
