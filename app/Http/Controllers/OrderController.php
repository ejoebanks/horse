<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use Illuminate\Http\Request;
use App\Order;
Use App\Notifications\OrderConfirmation;
use Illuminate\Notifications\Notification;
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

    public function listOrders()
    {
        $order = \DB::table('orders')
        ->join('services', 'services.id', '=', 'orders.serviceid')
        ->join('users', 'orders.employeeid', '=', 'users.id')
        ->join('locations', 'orders.locationid', '=', 'locations.id')
        ->join('buildings', 'orders.buildingid', '=', 'buildings.id')
        ->select('orders.*', 'orders.id as order_id', 'services.servicename as servname', 'users.firstname', 'users.lastname', 'locations.address', 'locations.city', 'locations.state', 'buildings.buildingname')
        ->where('orders.clientid', Auth::user()->id)
        ->get();
        return view('orders', compact('order'));
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
             'tied'=> $request->get('tied'),
             'color'=> $request->get('color'),
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
             'employeeid'=> '1',
             'clientid'=> \Auth::user()->id,
             'locationid'=> $request->get('locationid'),
             'tied'=> $request->get('tied'),
             'color'=> $request->get('color'),
             'buildingid'=> $request->get('buildingid'),
             'stablenumber'=> $request->get('stablenumber'),
             'scheduledtime'=> $request->get('scheduledtime'),
             'comments'=> $request->get('comments'),
             'status'=> $request->get('status')
         ]);

        $order->save();
        return redirect('/submitted');
    }

    public function lastOrder(){
      $ccc = \DB::table('orders')
            ->where('orders.clientid', Auth::user()->id)
            ->orderBy('orders.id', 'desc')
            ->rightjoin('buildings', 'orders.buildingid', '=', 'buildings.id')
            ->rightjoin('locations', 'orders.locationid', '=', 'locations.id')
            ->rightjoin('services', 'orders.serviceid', '=', 'services.id')
            ->select('orders.*', 'services.servicename', 'locations.city', 'locations.state', 'locations.address', 'buildings.buildingname')
            ->first();

      return view('layouts.orderplaced', compact('ccc'));
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
          'color'=> 'nullable',
          'tied'=> 'required',
          'locationid'=> 'required',
          'buildingid'=> 'required',
          'stablenumber'=> 'required',
          'scheduledtime'=> 'required',
          'comments'=> 'nullable',
          'status'=> 'required'
        ]);
        $data['id'] = $order_id;
        $order->updateOrder($data);

        return redirect('/orders');
    }

    public function reviseSubmit(Request $request, $id)
    {
        $order = Order::find($id);
        $data = $this->validate($request, [
          'horsename'=> 'required',
          'serviceid'=> 'required',
          'locationid'=> 'required',
          'color'=> 'nullable',
          'tied'=> 'required',
          'buildingid'=> 'required',
          'stablenumber'=> 'required',
          'scheduledtime'=> 'required',
          'comments'=> 'nullable',
        ]);
        $data['id'] = $id;
        $order->reviseO($data);

        return redirect('/submitted');
    }


    public function updateDate(Request $request)
    {
        $scheduledtime = $request->input('scheduledtime');
        $order_id = $request->input('order_id');
        $order = Order::find($order_id);
        $order->scheduledtime = $scheduledtime;
        $order->save();
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

    public function rejectOrder($order_id)
    {
        $order = Order::find($order_id);
        if ($order->status == 0) {
            $order->status = 3;
        }
        $order->save();
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

    public function completeOrder($order_id)
    {
        $order = Order::find($order_id);
        if ($order->status == 1) {
            $order->status = 2;
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
                  ->join('buildings', 'buildings.id', '=', 'orders.buildingid')
                  ->select('orders.*', 'buildings.buildingname AS building', 'orders.id as order_id')
                  ->get();

            $editable = true;
        } else {
            $data = \DB::table('orders')
                  ->where('employeeid', 1)
                  ->join('buildings', 'buildings.id', '=', 'orders.buildingid')
                  ->select('orders.*', 'buildings.buildingname AS building', 'orders.id as order_id')
                  ->get();
            $editable = false;

        }
        if ($data->count()) {
            foreach ($data as $key => $value) {
              if ( $value->status == 0){
                $bg = '#ffeeba';
              } else if ($value->status == 1) {
                $bg = '#bee5eb';
              } else {
                $bg = '#c3e6cb';
              }
                $events[] = Calendar::event(
                         $value->horsename." @ ".$value->building,
                         true, //Marks as full day
                         new \DateTime($value->scheduledtime),
                         new \DateTime($value->scheduledtime.' +1 day'),
                         $value->id,
                      [
                          'color' => $bg,
                          'textColor' => 'black',
                          'url' => action('OrderController@appointment', $value->order_id),
                          'editable' => $editable,
                                ]
                     );
            }
        }
        $cal = Calendar::addEvents($events)
        ->setCallbacks([ //set fullcalendar callback options (will not be JSON encoded)
        'eventDrop' => "function(event, delta, revertFunc) {
                    $(function() {
                        $.ajax({
                            url: '/calendar',
                            type: 'POST',
                            data: {
                              'method': 'POST',
                              'scheduledtime': event.start.format(),
                              'order_id' : event.id },
                        });
                      });
                    }"

    ]);

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

    public function reviseReview($id)
    {
        $order = Order::where('id', $id)
                    //->join('services', 'services.id', '=', 'orders.serviceid')
                    ->first();

        return view('crud.order.revise', compact('order', 'id'));
    }

    public function requestList()
    {
        $requestedAppts = DB::table('orders')
                ->where('orders.employeeid', Auth::user()->id)
                ->where('orders.status', 0)
                ->count();
          return view('layouts.app', compact('requestedAppts'));
    }
}
