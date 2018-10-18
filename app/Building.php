<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    protected $dbname = 'work';
    protected $table = 'buildings';

    protected $fillable = [
      'locationid', 'buildingname', 'comments',
  ];

    public function updateBuilding($data)
    {
        $building = $this->find($data['id']);
        $building->locationid = $data['locationid'];
        $building->buildingname = $data['buildingname'];
        $building->comments = $data['comments'];
        $building->save();
        return 1;
    }
}
