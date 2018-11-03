<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Location;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $location = \DB::table('locations')
        ->oldest()
        ->get();
        return view('crud.locations.index', compact('location'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('crud.locations.create');
    }


    public function store(Request $request)
    {
        $location = new Location([
             'address'=> $request->get('address'),
             'city'=> $request->get('city'),
             'state'=> $request->get('state')
         ]);

        $location->save();
        return redirect('/locations');
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
        $location = Location::where('id', $id)
                    ->first();


        return view('crud.locations.edit', compact('location', 'id'));
    }

    public function update(Request $request, $id)
    {
        $location = Location::find($id);
        $data = $this->validate($request, [
          'address'=>'required',
          'city'=> 'required',
          'state'=> 'required',
        ]);
        $data['id'] = $id;
        $location->updateLocation($data);

        return redirect('/locations');
    }


    public function destroy($id)
    {
        $location = Location::find($id);
        $location->delete();

        return redirect('/locations');
    }

    public function singleDestroy($id)
    {
        $location = Location::find($id);
        $location->delete();

        return redirect('/home');
    }

    public function approveLocation($id)
    {
        $location = Location::find($id);
        $location->status = 1;
        $location->save();
        return redirect('/home');
    }

    public function cancelLocation($id)
    {
        $location = Location::find($id);
        $location->status = 0;
        $location->save();
        return redirect('/home');
    }
}
