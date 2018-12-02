@extends('layouts.app')

@section('content')
    <div class="container">
      <table class="table table-striped">
        <thead>
            <tr>
              <td>ID</td>
              <td>Address</td>
              <td>City</td>
              <td>State</td>

              <td colspan="2">Action</td>
            </tr>
        </thead>
        <tbody>
            @foreach($location as $loc)
            <tr>
                <td>{{$loc->id}}</td>
                <td>{{$loc->address}}</td>
                <td>{{$loc->city}}</td>
                <td>{{$loc->state}}</td>
                <td><a href="{{action('LocationController@edit',$loc->id)}}" class="btn btn-primary">Edit</a></td>
                <td>
                    <form action="{{action('LocationController@destroy', $loc->id)}}" method="post">
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
    <a href="{{ action('LocationController@create') }}" button type="submit" class="btn btn-primary">Insert New Building</button></a>

<div>
@endsection
