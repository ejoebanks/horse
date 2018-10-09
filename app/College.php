<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class College extends Model
{
    protected $dbname = 'work';
    protected $table = 'college';

    protected $fillable = [
      'name', 'address', 'city', 'state', 'gpaReq', 'otherReqs',
  ];

    public function updateCollege($data)
    {
        $college = $this->find($data['id']);
        $college->name = $data['name'];
        $college->address = $data['address'];
        $college->city = $data['city'];
        $college->state = $data['state'];
        $college->gpaReq = $data['gpaReq'];
        $college->otherReqs = $data['otherReqs'];
        $college->save();
        return 1;
    }
}
