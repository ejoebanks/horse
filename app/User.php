<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'lastname', 'email', 'address', 'city', 'state', 'password', 'admin'
    ];

    public function updateUser($data)
    {
        $user = $this->find($data['id']);
        $user->firstname = $data['firstname'];
        $user->lastname = $data['lastname'];
        $user->address = $data['address'];
        $user->city = $data['city'];
        $user->state = $data['state'];
        $user->email = $data['email'];
        $user->admin = $data['admin'];
        $user->password = bcrypt($data['password']);
        $user->save();
        return 1;
    }

    public function singleUpdate($data)
    {
        $user = $this->find($data['id']);
        $user->firstname = $data['firstname'];
        $user->lastname = $data['lastname'];
        $user->address = $data['address'];
        $user->city = $data['city'];
        $user->state = $data['state'];
        $user->email = $data['email'];
        $user->save();
        return 1;
    }
}
