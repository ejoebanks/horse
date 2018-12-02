@extends('layouts.app')

@section('content')
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
      <form class="form-horizontal" role="form" method="POST" action="{{ action('LocationController@update',$location->id) }}">
           {!! csrf_field() !!}

           <input type="hidden" name="_method" value="PATCH">

        <div class="form-group">
            <input type="hidden" value="{{csrf_token()}}" name="_token" />
            <label for="city">City:</label>
            <input type="text" class="form-control" name="city" value="{{ $location->city }}" />
        </div>

        <div class="form-group">
            <input type="hidden" value="{{csrf_token()}}" name="_token" />
            <label for="address">Address:</label>
            <input type="text" class="form-control" name="address" value="{{ $location->address }}" />
        </div>

        <div class="form-group">
            <input type="hidden" value="{{csrf_token()}}" name="_token" />
            <label for="state">State:</label>
            <input type="text" class="form-control" name="state" value="{{ $location->state }}" />
          </div>

        <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>

@endsection
