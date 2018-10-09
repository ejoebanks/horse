@extends('layouts.app')

@section('content')
<?php
if (Auth::user() != null && Auth::user()->admin == 1) {
    ?>
    <div class="container">
      <table class="table table-striped">
        <thead>
            <tr>
              <td>Student ID</td>
              <td>Course ID</td>
              <td>Course Grade</td>

              <td colspan="2">Action</td>
            </tr>
        </thead>
        <tbody>
            @foreach($grade as $gr)
            <tr>
                <td>{{$gr->studentid}}</td>
                <td>{{$gr->courseid}}</td>
                <td>{{$gr->courseGrade}}</td>
                <td><a href="{{action('GradeController@edit',$gr->id)}}" class="btn btn-primary">Edit</a></td>
                <td>
                    <form action="{{action('GradeController@destroy', $gr->id)}}" method="post">
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
    <a href="{{ action('GradeController@create') }}" button type="submit" class="btn btn-primary">Insert New Grade</button></a>
    <?php
} else {
        ?>
      @include('functions.denied')
    <?php
    } ?>


<div>
@endsection
