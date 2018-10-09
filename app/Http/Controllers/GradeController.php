<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Grade;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grade = \DB::table('classgrade')->oldest()->get();
        return view('grade.index', compact('grade'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('grade.create');
    }


    public function store(Request $request)
    {
        $grade = new Grade([
             'studentid'=> $request->get('studentid'),
             'courseid'=> $request->get('courseid'),
             'courseGrade'=> $request->get('coursegrade')
         ]);

        $grade->save();
        return redirect('/grade');
    }

    public function storeHome(Request $request)
    {
        $grade = new Grade([
             'studentid'=> $id = \Auth::user()->id,
             'courseid'=> $request->get('courseid'),
             'courseGrade'=> $request->get('coursegrade')
         ]);

        $grade->save();
        return redirect('/home');
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
        $grade = Grade::where('id', $id)
                    ->first();

        return view('grade.edit', compact('grade', 'id'));
    }

    public function singleEdit($id)
    {
        $grade = Grade::where('id', $id)
                    ->first();

        return view('grade.edits', compact('grade', 'id'));
    }

    public function singleUpdate(Request $request, $id)
    {
        $grade = new Grade();
        $data = $this->validate($request, [
          'courseGrade'=> 'required',
        ]);
        $data['id'] = $id;
        $grade->updatePersonal($data);

        return redirect('/home');
    }


    public function update(Request $request, $id)
    {
        $grade = Grade::find($id);
        $data = $this->validate($request, [
          'studentid'=>'required',
          'courseid'=> 'required',
          'courseGrade'=> 'required',
        ]);
        $data['id'] = $id;
        $grade->UpdateGrade($data);

        return redirect('/grade');
    }


    public function destroy($id)
    {
        $grade = Grade::find($id);
        $grade->delete();

        return redirect('/grade');
    }

    public function singleDestroy($id)
    {
        $grade = Grade::find($id);
        $grade->delete();

        return redirect('/home');
    }
}
