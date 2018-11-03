<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $dbname = 'work';
    protected $table = 'orders';

    protected $fillable = [
      'serviceid', 'employeeid', 'clientid', 'locationid', 'buildingid',
      'stablenumber', 'horsename', 'comments'
  ];

    public function updateOrder($data)
    {
        $order = $this->find($data['id']);
        $order->serviceid = $data['serviceid'];
        $order->employeeid = $data['employeeid'];
        $order->clientid = $data['clientid'];
        $order->locationid = $data['locationid'];
        $order->buildingid = $data['buildingid'];
        $order->stablenumber = $data['stablenumber'];
        $order->horsename = $data['horsename'];
        $order->comments = $data['comments'];
        $order->save();
        return 1;
    }

    public function denyOrder($data)
    {
        $order = $this->find($data['id']);
        $order->courseGrade = $data['courseGrade'];
        $order->save();
        return 1;
    }

    public function viewAppointment($data)
    {
        $order = $this->find($data['id']);
        $order->serviceid = $data['serviceid'];
        $order->employeeid = $data['employeeid'];
        $order->clientid = $data['clientid'];
        $order->locationid = $data['locationid'];
        $order->stablenumber = $data['stablenumber'];
        $order->status = $data['status'];
        $order->save();
        return 1;
    }
}
