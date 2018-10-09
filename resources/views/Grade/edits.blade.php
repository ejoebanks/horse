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
<?php
if (Auth::user()->id == $grade->studentid) {
    $className = DB::table('classgrade')
      ->join('courses', 'courses.id', '=', 'classgrade.courseid')
      ->select('courses.coursename', 'courses.coursedescription')
      ->where('courses.id', '=', $grade->courseid)
      ->where('classgrade.studentid', '=', Auth::user()->id)
      ->get();

    foreach ($className as $class) {
        print("<h3>$class->coursename: $class->coursedescription</h3>");
        print("<h3>Current grade: $grade->courseGrade</h3>");
        print("<br/>");
    } ?>
    <div class="container">
      <form class="form-horizontal" role="form" method="POST" action="{{ action('GradeController@singleUpdate',$grade->id) }}">
           {!! csrf_field() !!}
           <input type="hidden" name="_method" value="PATCH">
          <div class="form-group">
            <input type="hidden" value="{{csrf_token()}}" name="_token" />
          <div class="form-group">
            <input type="hidden" name="_method" value="POST">
                  <select class="form-control" value="{{ $grade->courseGrade }}" name="courseGrade" id="courseGrade">
                    <option value='A'>A</option>
                    <option value='B'>B</option>
                    <option value='C'>C</option>
                    <option value='D'>D</option>
                    <option value='F'>F</option>
                  </select>
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
