  <option value="">None</option>
  <?php

      $RR = DB::table('courses')
        ->select('courses.id', 'courses.coursename')
        ->whereNotIn('id', function ($query) {
            $query
              ->select('courseid')
              ->from('classgrade')
              ->where('studentid', '=', Auth::user()->id);
        })
        ->orderBy('coursename', 'asc')
        ->distinct()
        ->get();


    foreach ($RR as $course) {
        ?>
      <option value="<?= $course->id ?>"><?= $course->coursename ?></option>
  <?php
    } ?>
