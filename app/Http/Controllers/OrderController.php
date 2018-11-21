<?php

namespace App\Http\Controllers;

use Auth;
use DB;
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
        ->select('orders.*', 'orders.id as order_id', 'services.servicename as servname', 'services.id as servid')
        ->oldest()
        ->get();
        return view('crud.order.index', compact('order'));
    }

    public function appointment($order_id)
    {
        $order = \DB::table('orders')
        ->join('services', 'services.id', '=', 'orders.serviceid')
        ->join('locations', 'locations.id', '=', 'orders.locationid')
        ->join('users', 'users.id', '=', 'orders.clientid')
        ->join('buildings', 'buildings.id', '=', 'orders.buildingid')
        ->select('orders.*', 'orders.id as order_id', 'services.servicename as servname', 'services.id as servid', 'locations.*', 'users.firstname', 'users.lastname', 'buildings.buildingname')
        ->where('orders.id', '=', $order_id)
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

    /*
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
    */

    public function show($order_id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $order_id
     * @return \Illuminate\Http\Response
     */
    public function edit($order_id)
    {
        $order = Order::where('id', $order_id)
                    //->join('services', 'services.id', '=', 'orders.serviceid')
                    ->first();

        return view('crud.order.edit', compact('order', 'order_id'));
    }

    public function singleEdit($order_id)
    {
        $order = Order::where('id', $order_id)
                    ->first();

        return view('crud.order.edits', compact('order', 'order_id'));
    }


    public function update(Request $request, $order_id)
    {
        $order = Order::find($order_id);
        $data = $this->validate($request, [
          'horsename'=> 'required',
          'serviceid'=> 'required',
          'employeeid'=> 'required',
          'clientid'=> 'required',
          'locationid'=> 'required',
          'buildingid'=> 'required',
          'stablenumber'=> 'required',
          'scheduledtime'=> 'required',
          'comments'=> 'required',
          'status'=> 'required'
        ]);
        $data['id'] = $order_id;
        $order->updateOrder($data);

        return redirect('/orders');
    }

    public function updateDate($scheduledtime, $order_id)
    {
        $order = Order::find($order_id);
        $order->scheduledtime = "11-11-1111";
        $order->save();
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

    public function approveOrder($order_id)
    {
        $order = Order::find($order_id);
        if ($order->status == 0) {
            $order->status = 1;
        }
        $order->save();
        return redirect('/home');
    }

    public function cancelOrder($order_id)
    {
        $order = Order::find($order_id);
        if ($order->status == 1) {
            $order->status = 0;
        }
        $order->save();
        return redirect('/home');
    }

    public function view($order_id)
    {
        $order = \DB::table('orders')
        ->join('services', 'services.id', '=', 'orders.serviceid')
        ->join('locations', 'locations.id', '=', 'orders.locationid')
        ->join('users', 'users.id', '=', 'orders.clientid')
        ->join('buildings', 'buildings.id', '=', 'orders.buildingid')
        ->select('orders.*', 'orders.id as order_id', 'services.servicename as servname', 'services.id as servid', 'locations.*', 'users.firstname', 'users.lastname', 'buildings.buildingname')
        ->where('orders.id', '=', $order_id)
        ->get();

        return view('crud.order.appointment', compact('order'));
    }

    public function calendar()
    {
        $events = [];
        //$data = Order::where('employeeid', \Auth::user()->id)->first();

        if (is_Object(Auth::user()) && Auth::user()->type == 1) {
            $data = \DB::table('orders')
                  ->where('employeeid', Auth::user()->id)
                  ->select('orders.*', 'orders.id as order_id')
                  ->get();
        } else {
            $data = \DB::table('orders')
                  ->where('employeeid', 1)
                  ->select('orders.*', 'orders.id as order_id')
                  ->get();
        }
        if ($data->count()) {
            foreach ($data as $key => $value) {
                $events[] = Calendar::event(
                         $value->horsename,
                         true, //Marks as full day
                         new \DateTime($value->scheduledtime),
                         new \DateTime($value->scheduledtime.' +1 day'),
                         $value->id,
                      [
                          'color' => '#17a2b8',
                          'url' => action('OrderController@appointment', $value->order_id),
                          'editable' => 'true',
                                ]
                     );
            }
        }
        $cal = Calendar::addEvents($events)
        ->setCallbacks([ //set fullcalendar callback options (will not be JSON encoded)
        'eventDrop' => "function(event, delta, revertFunc) {
                        alert(event.id + ' was dropped on ' + event.start.format());
                        $.ajax({
                            url: './change_date',
                            type: 'POST',
                            data: { 'scheduledtime': event.start.format(), 'order_id' : event.id },
                            success: function(event,delta,revertFunc)
                                        {
                                            alert('ok');
                                        }

                        });

                      }"
    ]);

        var_dump($events[1]->title);
        var_dump($events[1]->start);
        var_dump($events[1]->end);
        return view('calendar', compact('cal'));
    }

    public function homeList()
    {
        $requestQuery = DB::table('orders')
                     ->leftjoin('users as employee', 'employee.id', '=', 'orders.employeeid')
                     ->leftjoin('users as client', 'client.id', '=', 'orders.clientid')
                     ->join('services', 'services.id', '=', 'orders.serviceid')
                     ->join('buildings', 'buildings.id', '=', 'orders.buildingid')
                     ->join('locations', 'locations.id', '=', 'orders.locationid')
                     ->select('orders.*', 'orders.id as order_id', 'employee.firstname as emp_fname', 'client.firstname as client_fname', 'client.lastname as client_lname', 'locations.*', 'services.*', 'buildings.buildingname')
                     ->where('orders.employeeid', \Auth::user()->id)
                     ->get();

        return view('home', compact('requestQuery'));
    }
}
