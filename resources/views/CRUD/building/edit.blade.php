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
      <form class="form-horizontal" role="form" method="POST" action="{{ action('BuildingController@update',$building->id) }}">
           {!! csrf_field() !!}

           <input type="hidden" name="_method" value="PATCH">

        <div class="form-group">
            <input type="hidden" value="{{csrf_token()}}" name="_token" />
            <label for="locationid">Location:</label>
            <input type="text" class="form-control" name="locationid" value="{{ $building->locationid }}" />
        </div>

        <div class="form-group">
            <input type="hidden" value="{{csrf_token()}}" name="_token" />
            <label for="buildingname">Building Name:</label>
            <input type="text" class="form-control" name="buildingname" value="{{ $building->buildingname }}" />
        </div>

        <div class="form-group">
            <input type="hidden" value="{{csrf_token()}}" name="_token" />
            <label for="comments">Comments:</label>
            <input type="text" class="form-control" name="comments" value="{{ $building->comments }}" />
          </div>

        <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>

@endsection
