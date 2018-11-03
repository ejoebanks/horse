<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $dbname = 'work';
    protected $table = 'locations';

    protected $fillable = [
      'address', 'city', 'state'
  ];

    public function updateLocation($data)
    {
        $location = $this->find($data['id']);
        $location->address = $data['address'];
        $location->city = $data['city'];
        $location->state = $data['state'];
        $location->save();
        return 1;
    }
}
