@extends('layouts.app')

@section('content')
<?php
foreach($order as $ox){
  $emp_id = $ox->employeeid;
}
if (Auth::user() != null && Auth::user()->type == 1 && Auth::user()->id == $emp_id) {
    ?>
    <div class="container">
      <div class="row">
  <div class="col-sm-3"></div>
  <div class="col-sm-6">

      <table class="table table-striped">
        <thead>
            <tr>
            </tr>
        </thead>
        <tbody>
            @foreach($order as $or)
            <tr>
              <table class="table table-striped">
                <tbody>
                      <th>Client Name</th>
                        <td>{{$or->firstname}} {{ $or->lastname}}</td>
                    </tr>
                    <tr>
                      <th>Service Name</th>
                        <td>{{ $or->servname }}</td>
                    </tr>
                  <tr>
                      <th>Location</th>
                        <td>{{$or->address}}, {{ $or->city}}, {{$or->state}} </td>
                    </tr>
                    <tr>
                        <th>Building</th>
                          <td>{{ $or->buildingname}}</td>
                      </tr>
                      <tr>
                        <th>Stable Number</th>
                          <td>{{ $or->stablenumber }}</td>
                      </tr>

                      <tr>
                        <th>Requred Time</th>
                          <?php
                        $time = $or->scheduledtime;
                        $date = new DateTime($time);
                        $req_date = date_format($date, "F j, Y, g:i a");
                        ?>
                          <td> <?php print "$req_date" ?> </td>
                      </tr>

                </tbody>
              </table>
            </tr>
            @endforeach
        </tbody>
    </table>
  </div>
  <div class="col-sm-3"></div>
</div>

    <br/>
    <?php
} else {
        ?>
      @include('functions.denied')
    <?php
    } ?>


<div>
@endsection
