<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $dbname = 'work';
    protected $table = 'services';

    protected $fillable = [
      'servicename', 'servicedescription',
  ];

    public function updateService($data)
    {
        $service = $this->find($data['id']);
        $service->servicename = $data['servicename'];
        $service->servicedescription = $data['servicedescription'];
        $service->save();
        return 1;
    }
}
