@extends('layouts.app')

@section('content')

<!--
<div class="row">
  <div class="col-6 col-md-4">.col-6 .col-md-4</div>
  <div class="col-12 col-md-8">.col-12 .col-md-8</div>
</div>

<div class="row">
  <div class="col-6 col-md-4">.col-6 .col-md-4</div>
  <div class="col-6 col-md-4">.col-6 .col-md-4</div>
  <div class="col-6 col-md-4">.col-6 .col-md-4</div>
</div>

<div class="row">
  <div class="col-6">.col-6</div>
  <div class="col-6">.col-6</div>
</div>
-->
@if(Auth::user()->type == 1)
<br/>
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-4">
      <h1>Requested Appointments</h1>
<br/>
        <?php
        $requestQuery = DB::table('orders')
                       ->join('users', 'users.id', '=', 'orders.employeeid')
                       ->join('services', 'services.id', '=', 'orders.serviceid')
                       ->join('buildings', 'buildings.id', '=', 'orders.buildingid')
                       ->join('locations', 'locations.id', '=', 'orders.locationid')
                       ->select('orders.*', 'users.*', 'locations.*', 'services.*', 'buildings.buildingname')
                       ->where('orders.employeeid', Auth::user()->id)
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
              <a href="{{action('OrderController@appointment',$req->id)}}" class="btn btn-outline-dark btn-sm">View</a></td>
              <?php  echo str_repeat("&nbsp;", 3); ?>

              <a href="{{action('OrderController@approveOrder',$req->id)}}" class="btn btn-outline-dark btn-sm">Confirm</a></td>

              <?php  echo str_repeat("&nbsp;", 3); ?>

              <form action="}" method="post">
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

              <a href="{{action('OrderController@appointment',$req->id)}}" class="btn btn-outline-dark btn-sm">View</a></td>
              <?php  echo str_repeat("&nbsp;", 3); ?>

              <a href="" class="btn btn-outline-dark btn-sm">Request Change</a></td>

              <?php  echo str_repeat("&nbsp;", 3); ?>
              <a href="{{action('OrderController@cancelOrder',$req->id)}}" class="btn btn-outline-dark btn-sm">Cancel</a></td>


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

            <a href="{{action('OrderController@appointment',$req->id)}}" class="btn btn-outline-dark btn-sm">View</a></td>
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
@endif

@if(Auth::user()->type == 0)
<header class="business-header">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <h1 class="display-3 text-center text-white mt-4">Horse Braiding</h1>
      </div>
    </div>
  </div>
</header>

<!-- Page Content -->
<div class="container">

  <div class="row">
    <div class="col-sm-8">
      <h2 class="mt-4">What We Do</h2>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A deserunt neque tempore recusandae animi soluta quasi? Asperiores rem dolore eaque vel, porro, soluta unde debitis aliquam laboriosam. Repellat explicabo, maiores!</p>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis optio neque consectetur consequatur magni in nisi, natus beatae quidem quam odit commodi ducimus totam eum, alias, adipisci nesciunt voluptate. Voluptatum.</p>
      <p>
        <a class="btn btn-primary btn-lg" href="#">Call to Action &raquo;</a>
      </p>
    </div>
    <div class="col-sm-4">
      <h2 class="mt-4">Contact Us</h2>
      <address>
        <strong>Start Bootstrap</strong>
        <br>3481 Melrose Place
        <br>Beverly Hills, CA 90210
        <br>
      </address>
      <address>
        <abbr title="Phone">P:</abbr>
        (123) 456-7890
        <br>
        <abbr title="Email">E:</abbr>
        <a href="mailto:#">name@example.com</a>
      </address>
    </div>
  </div>
  <!-- /.row -->

  <div class="row">
    <div class="col-sm-4 my-4">
      <div class="card">
        <img class="card-img-top" src="http://placehold.it/300x200" alt="">
        <div class="card-body">
          <h4 class="card-title">Card title</h4>
          <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente esse necessitatibus neque sequi doloribus.</p>
        </div>
        <div class="card-footer">
          <a href="#" class="btn btn-primary">Find Out More!</a>
        </div>
      </div>
    </div>
    <div class="col-sm-4 my-4">
      <div class="card">
        <img class="card-img-top" src="http://placehold.it/300x200" alt="">
        <div class="card-body">
          <h4 class="card-title">Card title</h4>
          <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente esse necessitatibus neque sequi doloribus totam ut praesentium aut.</p>
        </div>
        <div class="card-footer">
          <a href="#" class="btn btn-primary">Find Out More!</a>
        </div>
      </div>
    </div>
    <div class="col-sm-4 my-4">
      <div class="card">
        <img class="card-img-top" src="http://placehold.it/300x200" alt="">
        <div class="card-body">
          <h4 class="card-title">Card title</h4>
          <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente esse necessitatibus neque.</p>
        </div>
        <div class="card-footer">
          <a href="#" class="btn btn-primary">Find Out More!</a>
        </div>
      </div>
    </div>

  </div>
  <!-- /.row -->

</div>

@endif


@endsection
