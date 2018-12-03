<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

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
       $id = Auth::user()->id;
         if ($id !== $routeFromID) {
             return redirect('/update/user/'.$id);
         }
         return $next($request);
     }
}
