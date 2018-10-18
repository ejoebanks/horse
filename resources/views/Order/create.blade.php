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
    <form method="post" action="{{ action('GradeController@store') }}">

<!--
        <div class="form-group">
            <input type="hidden" value="{{csrf_token()}}" name="_token"/>
            <label for="studentid">Student ID:</label>
            <input type="text" class="form-control" name="studentid" required/>
        </div>
      -->

        <div class="form-group">
          <input type="hidden" value="{{csrf_token()}}" name="_token"/>
            <label for="studentid">Student ID:</label>
                <select class="form-control" value="studentid" name="studentid" >
                  <?php
                      $users = DB::table('users')
                        ->select('users.id')
                        ->distinct()
                        ->get(); ?>
                      <option value="">None</option>

                <?php foreach ($users as $uid) {
                            ?>
                      <option value="<?= $uid->id ?>"><?= $uid->id ?></option>
                  <?php
                        } ?>
            </select>
          </div>

<!--
        <div class="form-group">
            <input type="hidden" value="{{csrf_token()}}" name="_token" />
            <label for="courseid">Course ID:</label>
            <input type="text" class="form-control" name="courseid"/>
        </div>
      -->
      <div class="form-group">
          <label for="courseid">Course ID:</label>
              <select class="form-control" value="courseid" name="courseid" id="courseid" required>
                <?php
                    $ZZ = DB::table('courses')
                      ->select('courses.id', 'courses.coursename')
                      ->distinct()
                      ->get(); ?>
                    <option value="">None</option>

              <?php foreach ($ZZ as $class) {
                          ?>
                    <option value="<?= $class->id ?>"><?= $class->id ?></option>
                <?php
                      } ?>
          </select>
        </div>


        <label for="coursegrade">Course Grade:</label>

        <div class="form-group">
                <select class="form-control" name="coursegrade" id="coursegrade">
                  <option value='A'>A</option>
                  <option value='B'>B</option>
                  <option value='C'>C</option>
                  <option value='D'>D</option>
                  <option value='F'>F</option>
                </select>
              </div>



        <button type="submit" class="btn btn-primary">Create</button>
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
