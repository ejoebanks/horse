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
              <td>Name</td>
              <td>Credits</td>
              <td>Course Description</td>

              <td colspan="2">Action</td>
            </tr>
        </thead>
        <tbody>
            @foreach($courses as $course)
            <tr>
                <td>{{$course->id}}</td>
                <td>{{$course->coursename}}</td>
                <td>{{$course->coursecredits}}</td>
                <td>{{$course->coursedescription}}</td>
                <td><a href="{{action('CourseController@edit',$course->id)}}" class="btn btn-primary">Edit</a></td>
                <td>
                    <form action="{{action('CourseController@destroy', $course->id)}}" method="post">
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
    <a href="{{ action('CourseController@create') }}" button type="submit" class="btn btn-primary">Insert New Course</button></a>
    <?php
} else {
        ?>
      @include('functions.denied')
    <?php
    } ?>


<div>
@endsection
