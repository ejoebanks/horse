<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $dbname = 'work';
    protected $table = 'courses';

    protected $fillable = [
      'coursename', 'coursecredits', 'coursedescription',
  ];

    public function updateCourse($data)
    {
        $course = $this->find($data['id']);
        //$user->id = auth()->user()->id;
        $course->coursename = $data['coursename'];
        $course->coursecredits = $data['coursecredits'];
        $course->coursedescription = $data['coursedescription'];
        $course->save();
        return 1;
    }
}
