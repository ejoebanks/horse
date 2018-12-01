<?php
public function handle($request, Closure $next)
{
    //check here if the user is authenticated
    if ( ! $this->auth->user() )
    {
      return redirect()->route('login');
    }

    return $next($request);
}
 ?>
