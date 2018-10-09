@extends('layouts.app')

@section('content')
<?php
?>
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-4">
      <h1>Requested Appointments</h1>
<br/>
        <?php
        $requestQuery = DB::table('orders')
                       ->join('orderstatus', 'orders.id', '=', 'orderstatus.orderid')
                       ->join('users', 'users.id', '=', 'orders.employeeid')
                       ->join('services', 'services.serviceid', '=', 'orders.serviceid')
                       ->join('buildings', 'buildings.buildingid', '=', 'orders.buildingid')
                       ->join('locations', 'locations.id', '=', 'orders.locationid')
                       ->select('orders.*', 'orderstatus.status', 'users.*', 'locations.*', 'services.*', 'buildings.buildingname')
                       ->get();
        foreach ($requestQuery as $req){
          if($req->status == 0){
            $servicename = $req->servicename;
            $client = $req->firstname." ".$req->lastname;
            $loc = $req->address;
            $stable = $req->stablenumber;
            $building = $req->buildingname;
            $time = $req->scheduledtime;
            $date = new DateTime($time);
            $req_date = date_format($date, "F j, Y, g:i a");

            print "<h4><strong>Time:</strong> $req_date</h4>";
            print "<h4><strong>Service:</strong> $servicename<br/></h4>";
            print "<h4><strong>Location:</strong> $loc</h4>";
            print "<h4><strong>Building:</strong> $building</h4>";
            print "<h4><strong>Client:</strong> $client</h4>";
            ?>
          <div class="container">
            <div class = "row">
              <a href="" class="btn btn-outline-dark btn-sm">View</a></td>
              <?php  echo str_repeat("&nbsp;", 3); ?>

              <a href="{{action('GradeController@singleEdit',$req->id)}}" class="btn btn-outline-dark btn-sm">Confirm</a></td>

              <?php  echo str_repeat("&nbsp;", 3); ?>

              <form action="{{action('GradeController@singleDestroy',$req->id)}}" method="post">
                {{csrf_field()}}
                <input name="_method" type="hidden" value="DELETE">
                <button class="btn btn-outline-dark btn-sm" onclick="return confirm('Are you sure?')" type="submit">Deny</button>
              </form>
            </div>
          </div>
          <?php
          print "<br/>";
        }
        }

        $uid = Auth::user()->id;
            $userQuery = DB::table('users')
              ->where('users.id', '=', $uid)
              ->select('users.*')
              ->get();


              $servicesQuery = DB::table('services')
                ->select('services.*')
                ->get();
 ?>

                    <div class="container">
                      <div class = "row">
                      </div>
                    </div>

                    <?php

            ?>
    </div>

    <div class="col-sm-4">
      <div class="cliente">
        <h1> Accepted Appointments </h1>
        <br/>
        <?php
        foreach ($requestQuery as $req){
          if($req->status == 1){
            $servicename = $req->servicename;
            $client = $req->firstname." ".$req->lastname;
            $loc = $req->address;
            $stable = $req->stablenumber;
            $building = $req->buildingname;
            $time = $req->scheduledtime;
            $date = new DateTime($time);
            $req_date = date_format($date, "F j, Y, g:i a");

            print "<h4><strong>Time:</strong> $req_date</h4>";
            print "<h4><strong>Service:</strong> $servicename<br/></h4>";
            print "<h4><strong>Location:</strong> $loc</h4>";
            print "<h4><strong>Building:</strong> $building</h4>";
            print "<h4><strong>Client:</strong> $client</h4>";
            ?>
          <div class="container">
            <div class = "row">

              <a href="" class="btn btn-outline-dark btn-sm">View</a></td>
              <?php  echo str_repeat("&nbsp;", 3); ?>

              <a href="{{action('GradeController@singleEdit',$req->id)}}" class="btn btn-outline-dark btn-sm">Request Change</a></td>

              <?php  echo str_repeat("&nbsp;", 3); ?>
              <a href="{{action('GradeController@singleEdit',$req->id)}}" class="btn btn-outline-dark btn-sm">Cancel</a></td>


        </div>
          </div>
          <?php
          print "<br/>";
        }
        }
?>
        </div>
    </div>

    <div class="col-sm-4"><h1>Completed Appointments</h1>
      <br/>
      <?php
      foreach ($requestQuery as $req){
        if($req->status == 2){
          $servicename = $req->servicename;
          $client = $req->firstname." ".$req->lastname;
          $loc = $req->address;
          $stable = $req->stablenumber;
          $building = $req->buildingname;
          $time = $req->scheduledtime;
          $date = new DateTime($time);
          $req_date = date_format($date, "F j, Y, g:i a");

          print "<h4><strong>Time:</strong> $req_date</h4>";
          print "<h4><strong>Service:</strong> $servicename<br/></h4>";
          print "<h4><strong>Location:</strong> $loc</h4>";
          print "<h4><strong>Building:</strong> $building</h4>";
          print "<h4><strong>Client:</strong> $client</h4>";
          ?>
        <div class="container">
          <div class = "row">

            <a href="" class="btn btn-outline-dark btn-sm">View</a></td>
          </div>
        </div>
        <?php
        print "<br/>";
      }
      }
?>
  </div>
</div>
</div>
</div>
@endsection
