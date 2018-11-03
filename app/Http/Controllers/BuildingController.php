<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Building;

class BuildingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$users = User::where('id', auth()->user()->id)->get();
        $building = \DB::table('buildings')->oldest()->get();
        return view('crud.building.index', compact('building'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('crud.building.create');
    }

    public function store(Request $request)
    {
        $building = new Building([
            'locationid'=>$request->get('locationid'),
            'buildingname'=> $request->get('buildingname'),
            'comments'=> $request->get('comments'),
        ]);

        $building->save();
        return redirect('/buildings');
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
        $building = Building::where('id', $id)
                      ->first();

        return view('crud.building.edit', compact('building', 'id'));
    }

    public function update(Request $request, $id)
    {
        $building = new Building();
        $data = $this->validate($request, [
          'locationid'=>'required',
          'buildingname'=> 'required',
          'comments'=> 'required',
        ]);
        $data['id'] = $id;
        $building->updateBuilding($data);

        return redirect('/buildings');
    }


    public function destroy($id)
    {
        $building = Building::find($id);
        $building->delete();

        return redirect('/buildings');
    }
}
