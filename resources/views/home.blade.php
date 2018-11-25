@extends('layouts.app')

@section('content')

@if(Auth::user()->type == 1)
<br/>
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-4">
      <h1>Requested Appointments</h1>
      <br/>
        <?php
        foreach ($requestQuery as $req) {
            if ($req->status == 0) {
                $servicename = $req->servicename;
                $client = $req->client_fname." ".$req->client_lname;
                $loc = $req->address.", ".$req->city.", ".$req->state;
                $stable = $req->stablenumber;
                $building = $req->buildingname;
                $time = $req->scheduledtime;
                $horse = $req->horsename;
                //$date = new DateTime($time);
                //$req_date = date_format($date, "F j, Y, g:i a");

                print "<ul class='list-group'>";
                print "<li class='list-group-item list-group-item-warning' ><h4> $client </h4></li>";
                print "<li class='list-group-item'>$horse </li>";
                print "<li class='list-group-item'>$time </li>";
                print "<li class='list-group-item'> $servicename </li>";
                print "<li class='list-group-item'> $loc </li>";
                print "<li class='list-group-item'>$building </li>";
                print "<li class='list-group-item'>"; ?> <div class="container">
                        <div class = "row">
                          <a href="{{action('OrderController@appointment', $req->order_id)}}" class="btn btn-outline-dark btn-sm">View</a></td>
                          <?php  echo str_repeat("&nbsp;", 3); ?>

                          <a href="{{action('OrderController@approveOrder', $req->order_id)}}" class="btn btn-outline-dark btn-sm">Confirm</a></td>

                          <?php  echo str_repeat("&nbsp;", 3); ?>

                          <form action="}" method="post">
                            {{csrf_field()}}
                            <input name="_method" type="hidden" value="DELETE">
                            <button class="btn btn-outline-dark btn-sm" onclick="return confirm('Are you sure?')" type="submit">Deny</button>
                          </form>
                        </div>
                      </div><?php
            print "</li>";
                print "</ul>";
                print "<br/>";
            }
        }
 ?>
                    <div class="container">
                      <div class = "row">
                      </div>
                    </div>
    </div>
    <div class="col-sm-4">
      <div class="cliente">
        <h1> Accepted Appointments </h1>
        <br/>
        <?php
        foreach ($requestQuery as $req) {
            if ($req->status == 1) {
                $servicename = $req->servicename;
                $client = $req->client_fname." ".$req->client_lname;
                $loc = $req->address.", ".$req->city.", ".$req->state;
                $stable = $req->stablenumber;
                $horse = $req->horsename;
                $building = $req->buildingname;
                $time = $req->scheduledtime;
                //$date = new DateTime($time);
                //$req_date = date_format($date, "F j, Y, g:i a");

                print "<ul class='list-group'>";
                print "<li class='list-group-item list-group-item-info' ><h4> $client </h4></li>";
                print "<li class='list-group-item'>$horse </li>";
                print "<li class='list-group-item'>$time </li>";
                print "<li class='list-group-item'> $servicename </li>";
                print "<li class='list-group-item'> $loc </li>";
                print "<li class='list-group-item'>$building </li>";
                print "<li class='list-group-item'>"; ?> <div class="container">
                        <div class = "row">
                          <a href="{{action('OrderController@appointment',$req->order_id)}}" class="btn btn-outline-dark btn-sm">View</a></td>
                          <?php  echo str_repeat("&nbsp;", 3); ?>

                          <a href="" class="btn btn-outline-dark btn-sm">Request Change</a></td>

                          <?php  echo str_repeat("&nbsp;", 3); ?>
                          <a href="{{action('OrderController@cancelOrder',$req->order_id)}}" class="btn btn-outline-dark btn-sm">Cancel</a></td>
                        </div>
                      </div><?php
            print "</li>";
                print "</ul>";
                print "<br/>";
            }
        }
?>
        </div>
    </div>

    <div class="col-sm-4"><h1>Completed Appointments</h1>
      <br/>
      <?php
      foreach ($requestQuery as $req) {
          if ($req->status == 2) {
              $servicename = $req->servicename;
              $client = $req->client_fname." ".$req->client_lname;
              $loc = $req->address.", ".$req->city.", ".$req->state;
              $stable = $req->stablenumber;
              $horse = $req->horsename;
              $building = $req->buildingname;
              $time = $req->scheduledtime;
              //$date = new DateTime($time);
              //$req_date = date_format($date, "F j, Y, g:i a");

              print "<ul class='list-group'>";
              print "<li class='list-group-item list-group-item-success' ><h4> $client </h4></li>";
              print "<li class='list-group-item'>$horse </li>";
              print "<li class='list-group-item'>$time </li>";
              print "<li class='list-group-item'> $servicename </li>";
              print "<li class='list-group-item'> $loc </li>";
              print "<li class='list-group-item'>$building </li>";
              print "<li class='list-group-item'>"; ?> <div class="container">
                      <div class = "row">
                        <a href="{{action('OrderController@appointment',$req->order_id)}}" class="btn btn-outline-dark btn-sm">View</a></td>
                      </div>
                    </div><?php
          print "</li>";
              print "</ul>";
              print "<br/>";
              print "<br/>";
          }
      }
?>
  </div>
</div>
</div>
@endif

@if(Auth::user()->type == 0)
@include('landing')
@endif
@endsection
