@extends('layouts.app')

@section('content')
<?php
if (Auth::user() != null && Auth::user()->admin == 1) {
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
      <form class="form-horizontal" role="form" method="POST" action="{{ action('BpController@update',$bloodpressures->id) }}">
           {!! csrf_field() !!}

           <input type="hidden" name="_method" value="PATCH">

        <div class="form-group">
            <input type="hidden" value="{{csrf_token()}}" name="_token" />
            <label for="laying">Laying:</label>
            <input type="text" class="form-control" name="laying" value="{{ $bloodpressures->laying }}" />
        </div>

        <div class="form-group">
            <input type="hidden" value="{{csrf_token()}}" name="_token" />
            <label for="sitting">Sitting:</label>
            <input type="text" class="form-control" name="sitting" value="{{ $bloodpressures->sitting }}" />
        </div>

        <div class="form-group">
            <input type="hidden" value="{{csrf_token()}}" name="_token" />
            <label for="standing">Standing:</label>
            <input type="text" class="form-control" name="standing" value="{{ $bloodpressures->standing }}" />
        </div>

        <div class="form-group">
            <input type="hidden" value="{{csrf_token()}}" name="_token" />
            <label for="heart_rate">Heart Rate:</label>
            <input type="text" class="form-control" name="heart_rate" value="{{ $bloodpressures->heart_rate }}" />
        </div>


          <div class="form-group">
              <input type="hidden" value="{{csrf_token()}}" name="_token" />
              <label for="notes">Notes:</label>
              <input type="text" class="form-control" name="notes" value="{{ $bloodpressures->notes }}" />
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
