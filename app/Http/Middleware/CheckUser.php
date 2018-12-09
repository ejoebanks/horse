<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Order;

class CheckUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function handle($request, Closure $next)
    {
        $routeFromID = $int = (int) preg_replace('/\D/', '', $request->route()->parameters()['id']);
        $reqRoute = $request->route()->uri;

        $id = Auth::user()->id;
        if ($id !== $routeFromID && $reqRoute == "update/user/{id}") {
            return redirect('/update/user/'.$id);
        }

        if(!is_object(Order::find($routeFromID)) && $reqRoute == 'view/{id}'){
          return redirect()->back();
        }

        if ($reqRoute == 'view/{id}') {
            $amt = Order::select('clientid')->where('id', $routeFromID)->value('clientid');
            if ($id != $amt && Auth::user()->type != 1) {
                return redirect()->back();
            }
        }

        return $next($request);
    }
}
