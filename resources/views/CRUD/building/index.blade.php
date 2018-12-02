@extends('layouts.app')

@section('content')
    <div class="container">
      <table class="table table-striped">
        <thead>
            <tr>
              <td>ID</td>
              <td>Location</td>
              <td>Name</td>
              <td>Comments</td>

              <td colspan="2">Action</td>
            </tr>
        </thead>
        <tbody>
            @foreach($building as $bldg)
            <tr>
                <td>{{$bldg->id}}</td>
                <td>{{$bldg->locationid}}</td>
                <td>{{$bldg->buildingname}}</td>
                <td>{{$bldg->comments}}</td>
                <td><a href="{{action('BuildingController@edit',$bldg->id)}}" class="btn btn-primary">Edit</a></td>
                <td>
                    <form action="{{action('BuildingController@destroy', $bldg->id)}}" method="post">
                    {{csrf_field()}}
                    <input name="_method" type="hidden" value="DELETE">
                    <button class="btn btn-danger" onclick="return confirm('Are you sure?')" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <br/>
    <a href="{{ action('BuildingController@create') }}" button type="submit" class="btn btn-primary">Insert New Building</button></a>
<div>
@endsection
