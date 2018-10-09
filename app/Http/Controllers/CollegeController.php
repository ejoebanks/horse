<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\College;

class CollegeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$users = User::where('id', auth()->user()->id)->get();
        $colleges = \DB::table('college')->oldest()->get();
        return view('colleges.index', compact('colleges'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('colleges.create');
    }

    public function store(Request $request)
    {
        $colleges = new College([
            'name'=>$request->get('name'),
            'address'=> $request->get('address'),
            'city'=> $request->get('city'),
            'state'=> $request->get('state'),
            'gpaReq'=> $request->get('gpaReq'),
            'otherReqs'=> $request->get('otherReqs')
        ]);

        $colleges->save();
        return redirect('/colleges');
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
        $college = College::where('id', $id)
                      ->first();

        return view('colleges.edit', compact('college', 'id'));
    }

    public function update(Request $request, $id)
    {
        $college = new College();
        $data = $this->validate($request, [
          'name'=>'required',
          'address'=> 'required',
          'city'=> 'required',
          'state'=> 'required',
          'gpaReq'=> 'required',
          'otherReqs'=> 'required'
        ]);
        $data['id'] = $id;
        $college->updateCollege($data);

        return redirect('/colleges');
    }


    public function destroy($id)
    {
        $college = College::find($id);
        $college->delete();

        return redirect('/colleges');
    }
}
