@extends('layouts.app')

@section('content')
<?php
if (Auth::user() != null && Auth::user()->admin == 1) {
    ?>

<div class="container">
    <table class="table table-striped">
        <thead>
            <tr>
              <td>ID</td>
              <td>Laying</td>
              <td>Sitting</td>
              <td>Standing</td>
              <td>Heart Rate</td>
              <td>Notes</td>

              <td colspan="2">Action</td>
            </tr>
        </thead>
        <tbody>
            @foreach($bloodpressures as $bp)
            <tr>
                <td>{{$bp->id}}</td>
                <td>{{$bp->sitting}}</td>
                <td>{{$bp->standing}}</td>
                <td>{{$bp->laying}}</td>
                <td>{{$bp->heart_rate}}</td>
                <td>{{$bp->notes}}</td>

                <td><a href="{{action('BpController@edit',$bp->id)}}" class="btn btn-primary">Edit</a></td>
                <td>
                    <form action="{{action('BpController@destroy', $bp->id)}}" method="post">
                    {{csrf_field()}}
                    <input name="_method" type="hidden" value="DELETE">
                    <button class="btn btn-danger" onclick="return confirm('Are you sure?')" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ action('BpController@create') }}" button type="submit" class="btn btn-primary">Insert New BP</button></a>
    <a href="/results" button class="btn btn-primary">See Results</button></a>

<div>
  <?php
} else {
        ?>
    @include('functions.denied')
  <?php
    } ?>

@endsection
