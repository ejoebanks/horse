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
      <form class="form-horizontal" role="form" method="POST" action="{{ action('GradeController@update',$grade->id) }}">
           {!! csrf_field() !!}

           <input type="hidden" name="_method" value="PATCH">
<!--
        <div class="form-group">
            <input type="hidden" value="{{csrf_token()}}" name="_token" />
            <label for="studentid">Student ID:</label>
            <input type="text" class="form-control" name="studentid" value="{{ $grade->studentid }}" />
        </div>
-->
        <div class="form-group">
            <label for="studentid">Student ID:</label>
                <select class="form-control" value="studentid" name="studentid" id="studentid">
                  <?php
                      $RR = DB::table('users')
                        ->select('users.id')
                        ->where('users.id', '!=', $grade->studentid)
                        ->distinct()
                        ->get(); ?>
                      <option value="{{ $grade->studentid }}">{{ $grade->studentid }}</option>

                <?php foreach ($RR as $uid) {
                            ?>
                      <option value="<?= $uid->id ?>"><?= $uid->id ?></option>
                  <?php
                        } ?>
            </select>
          </div>

          <div class="form-group">
              <label for="courseid">Course ID:</label>
                  <select class="form-control" value="courseid" name="courseid" id="courseid">
                    <?php
                        $ZZ = DB::table('courses')
                          ->select('courses.id', 'courses.coursename')
                          ->where('courses.id', '!=', $grade->courseid)
                          ->distinct()
                          ->get(); ?>
                        <option value="{{ $grade->courseid }}">{{ $grade->courseid }}</option>

                  <?php foreach ($ZZ as $class) {
                              ?>
                        <option value="<?= $class->id ?>"><?= $class->id ?></option>
                    <?php
                          } ?>
              </select>
            </div>

      <!--  <div class="form-group">
            <input type="hidden" value="{{csrf_token()}}" name="_token" />
            <label for="courseid">Course ID:</label>
            <input type="text" class="form-control" name="courseid" value="{{ $grade->courseid }}" />
        </div>

        <div class="form-group">
            <input type="hidden" value="{{csrf_token()}}" name="_token" />
            <label for="courseGrade">Course Grade:</label>
            <input type="text" class="form-control" name="courseGrade" value="{{ $grade->courseGrade }}" />
          </div>
        -->

        <div class="form-group">
            <label for="courseGrade">Course Grade:</label>
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
