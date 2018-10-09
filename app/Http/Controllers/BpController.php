<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\BloodPressure;

class BpController extends Controller
{
  public function index()
  {
      $bloodpressures = \DB::table('bloodpressure')->oldest()->get();

      return view('bp.index', compact('bloodpressures'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
      return view('bp.create');
  }

  public function store(Request $request)
  {
      $bloodpressures = new BloodPressure([
          'sitting'=>$request->get('sitting'),
          'laying'=> $request->get('laying'),
          'standing'=> $request->get('standing'),
          'heart_rate'=> $request->get('heart_rate'),
          'notes'=> $request->get('notes'),
          'timestamp'=> date_default_timezone_get()
      ]);

      $bloodpressures->save();
      return redirect('/bp');
  }

public function storeBp(Request $request)
{
    $bloodpressures = new BloodPressure([
         'sitting'=> $id = $request->get('sitting'),
         'standing'=> $request->get('standing'),
         'laying'=> $request->get('laying'),
         'heart_rate'=> $request->get('heart_rate'),
         'notes'=> $request->get('notes'),
         'time_stamp'=> $date = date_default_timezone_get()
     ]);

    $bloodpressures->save();
    return redirect('/bp');
}

public function edit($id)
{
    $bloodpressures = BloodPressure::where('id', $id)
                ->first();

    return view('bp.edit', compact('bloodpressures', 'id'));
}

public function update(Request $request, $id)
{
    $bloodpressures = new BloodPressure();
    $data = $this->validate($request, [
      'laying'=>'required',
      'sitting'=> 'required',
      'standing'=> 'required',
      'heart_rate'=> 'required',
      'notes'=> 'required',
    ]);
    $data['id'] = $id;
    $bloodpressures->updateBp($data);

    return redirect('/bp');
}

public function destroy($id)
{
    $bloodpressures = BloodPressure::find($id);
    $bloodpressures->delete();

    return redirect('/bp');
}

}
