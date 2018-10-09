<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$users = User::where('id', auth()->user()->id)->get();
        $courses = \DB::table('courses')->oldest()->get();
        return view('courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('courses.create');
    }

    public function store(Request $request)
    {
        $course = new Course([
            'coursename'=>$request->get('coursename'),
            'coursecredits'=> $request->get('coursecredits'),
            'coursedescription'=> $request->get('coursedescription'),
        ]);

        $course->save();
        return redirect('/courses');
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
        $course = Course::where('id', $id)
                      ->first();

        return view('courses.edit', compact('course', 'id'));
    }

    public function update(Request $request, $id)
    {
        $course = new Course();
        $data = $this->validate($request, [
          'coursename'=>'required',
          'coursecredits'=> 'required',
          'coursedescription'=> 'required',
        ]);
        $data['id'] = $id;
        $course->updateCourse($data);

        return redirect('/courses');
    }


    public function destroy($id)
    {
        $course = Course::find($id);
        $course->delete();

        return redirect('/courses');
    }
}
