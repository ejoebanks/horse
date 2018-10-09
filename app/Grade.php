<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $dbname = 'work';
    protected $table = 'classgrade';

    protected $fillable = [
      'studentid', 'courseid', 'courseGrade',
  ];

    public function updateGrade($data)
    {
        $grade = $this->find($data['id']);
        $grade->studentid = $data['studentid'];
        $grade->courseid = $data['courseid'];
        $grade->courseGrade = $data['courseGrade'];
        $grade->save();
        return 1;
    }

    public function updatePersonal($data)
    {
        $grade = $this->find($data['id']);
        $grade->courseGrade = $data['courseGrade'];
        $grade->save();
        return 1;
    }
}
