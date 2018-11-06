<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\Order;
use MaddHatter\LaravelFullcalendar\Facades\Calendar;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order = \DB::table('orders')
        ->join('services', 'services.id', '=', 'orders.serviceid')
        ->select('orders.*', 'services.servicename as servname', 'services.id as servid')
        ->oldest()
        ->get();
        return view('crud.order.index', compact('order'));
    }

    public function appointment($id)
    {
        $order = \DB::table('orders')
        ->join('services', 'services.id', '=', 'orders.serviceid')
        ->join('locations', 'locations.id', '=', 'orders.locationid')
        ->join('users', 'users.id', '=', 'orders.clientid')
        ->join('buildings', 'buildings.id', '=', 'orders.buildingid')
        ->select('orders.*', 'services.servicename as servname', 'services.id as servid', 'locations.*', 'users.firstname', 'users.lastname', 'buildings.buildingname')
        ->where('orders.id', '=', $id)
        ->get();

        return view('crud.order.appointment', compact('order'));
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('crud.order.create');
    }


    public function store(Request $request)
    {
        $order = new Order([
             'horsename'=> $request->get('horsename'),
             'serviceid'=> $request->get('serviceid'),
             'employeeid'=> $request->get('employeeid'),
             'clientid'=> $request->get('clientid'),
             'locationid'=> $request->get('locationid'),
             'buildingid'=> $request->get('buildingid'),
             'stablenumber'=> $request->get('stablenumber'),
             'scheduledtime'=> $request->get('scheduledtime'),
             'status'=> $request->get('status')
         ]);

        $order->save();
        return redirect('/orders');
    }

    public function scheduleAppt(Request $request)
    {
        $order = new Order([
             'horsename'=> $request->get('horsename'),
             'serviceid'=> $request->get('serviceid'),
             'employeeid'=> $request->get('employeeid'),
             'clientid'=> \Auth::user()->id,
             'locationid'=> $request->get('locationid'),
             'buildingid'=> $request->get('buildingid'),
             'stablenumber'=> $request->get('stablenumber'),
             'scheduledtime'=> $request->get('scheduledtime'),
             'status'=> $request->get('status')
         ]);

        $order->save();
        return redirect('/submitted');
    }


    public function storeHome(Request $request)
    {
        $order = new Order([
             'studentid'=> $id = \Auth::user()->id,
             'courseid'=> $request->get('courseid'),
             'courseorder'=> $request->get('courseorder')
         ]);

        $order->save();
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
        $order = Order::where('id', $id)
                    ->join('services', 'services.id', '=', 'orders.serviceid')
                    ->first();


        return view('crud.order.edit', compact('order', 'id'));
    }

    public function singleEdit($id)
    {
        $order = Order::where('id', $id)
                    ->first();

        return view('crud.order.edits', compact('order', 'id'));
    }

    public function singleUpdate(Request $request, $id)
    {
        $order = new Order();
        $data = $this->validate($request, [
          'courseorder'=> 'required',
        ]);
        $data['id'] = $id;
        $order->updatePersonal($data);

        return redirect('/home');
    }


    public function update(Request $request, $id)
    {
        $order = Order::find($id);
        $data = $this->validate($request, [
          'studentid'=>'required',
          'courseid'=> 'required',
          'courseorder'=> 'required',
        ]);
        $data['id'] = $id;
        $order->Updateorder($data);

        return redirect('/orders');
    }


    public function destroy($id)
    {
        $order = Order::find($id);
        $order->delete();

        return redirect('/orders');
    }

    public function singleDestroy($id)
    {
        $order = Order::find($id);
        $order->delete();

        return redirect('/home');
    }

    public function approveOrder($id)
    {
        $order = Order::find($id);
        $order->status = 1;
        $order->save();
        return redirect('/home');
    }

    public function cancelOrder($id)
    {
        $order = Order::find($id);
        $order->status = 0;
        $order->save();
        return redirect('/home');
    }

    public function view($id)
    {
        $order = \DB::table('orders')
        ->join('services', 'services.id', '=', 'orders.serviceid')
        ->join('locations', 'locations.id', '=', 'orders.locationid')
        ->join('users', 'users.id', '=', 'orders.clientid')
        ->join('buildings', 'buildings.id', '=', 'orders.buildingid')
        ->select('orders.*', 'services.servicename as servname', 'services.id as servid', 'locations.*', 'users.firstname', 'users.lastname', 'buildings.buildingname')
        ->where('orders.id', '=', $id)
        ->get();

        return view('crud.order.appointment0', compact('order'));
    }

    public function calendar()
         {
             $events = [];
             //$data = Order::where('employeeid', \Auth::user()->id)->first();
             $data = \DB::table('orders')
                ->where('employeeid', Auth::user()->id)
                ->get();
             if($data->count()) {
                 foreach ($data as $key => $value) {
                     $events[] = Calendar::event(
                         $value->horsename,
                         true,
                         new \DateTime($value->scheduledtime),
                         new \DateTime($value->scheduledtime.' +1 day'),
                         null,
                      [
                          'color' => '#17a2b8',
                          'url' => action('OrderController@appointment', $value->id),
                      ]
                     );
                 }
             }
             $cal = Calendar::addEvents($events);
             return view('calendar', compact('cal'));
         }

}
