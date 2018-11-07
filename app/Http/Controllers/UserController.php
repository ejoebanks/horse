<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$users = User::where('id', auth()->user()->id)->get();
        $users = \DB::table('users')->oldest()->get();
        return view('crud.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('crud.users.create');
    }

    public function store(Request $request)
    {
        $user = new User([
            'firstname'=>$request->get('firstname'),
            'lastname'=>$request->get('lastname'),
            'address'=> $request->get('address'),
            'city'=> $request->get('city'),
            'state'=> $request->get('state'),
            'email'=> $request->get('email'),
            'type'=> $request->get('type'),
            'password'=> bcrypt($request->get('password'))
        ]);

        $user->save();
        return redirect('/users');
    }

    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      
        $user = User::where('id', $id)
                      ->first();

        return view('crud.users.edit', compact('user', 'id'));
    }

    public function singleEdit($id)
    {
        $user = User::where('id', $id)
                      ->first();

        return view('crud.users.update', compact('user', 'id'));
    }

    public function update(Request $request, $id)
    {
        $user = new User();
        $data = $this->validate($request, [
          'firstname'=>'required|string|max:255',
          'lastname'=>'required|string|max:255',
          'address'=> 'required|string|max:255',
          'city'=> 'required|string|max:255',
          'state'=> 'required|string|max:255',
          'email'=> 'required|string|email|max:255',
          'password'=> 'required|string|min:6',
          'type'=> 'required'
        ]);
        $data['id'] = $id;
        $user->updateUser($data);

        return redirect('/users');
    }

    public function singleUpdate(Request $request, $id)
    {
        $user = new User();
        $data = $this->validate($request, [
          'firstname'=>'required|string|max:255',
          'lastname'=>'required|string|max:255',
          'address'=> 'required|string|max:255',
          'city'=> 'required|string|max:255',
          'state'=> 'required|string|max:255',
          'email'=> 'required|string|email|max:255'
        ]);
        $data['id'] = $id;
        $user->singleUpdate($data);

        return redirect('/home');
    }


    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect('/users');
    }
}
