<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$users = User::where('id', auth()->user()->id)->get();
        $service = \DB::table('services')->oldest()->get();
        return view('crud.service.index', compact('service'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('crud.service.create');
    }

    public function store(Request $request)
    {
        $service = new Service([
            'servicename'=>$request->get('servicename'),
            'servicedescription'=> $request->get('servicedescription'),
        ]);

        $service->save();
        return redirect('/services');
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
        $service = Service::where('id', $id)
                      ->first();

        return view('crud.service.edit', compact('service', 'id'));
    }

    public function update(Request $request, $id)
    {
        $service = new Service();
        $data = $this->validate($request, [
          'servicename'=>'required',
          'servicedescription'=> 'required',
        ]);
        $data['id'] = $id;
        $service->updateService($data);

        return redirect('/services');
    }


    public function destroy($id)
    {
        $service = Service::find($id);
        $service->delete();

        return redirect('/services');
    }
}
