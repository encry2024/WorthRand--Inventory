<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Auth;

class AuthenticateWithStatus
{
   protected $auth;

	public function __construct(Guard $auth)
	{
		$this->auth = $auth;
	}
   /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @return mixed
   */
   public function handle($request, Closure $next)
   {
      $checkStatus = Auth::getLastAttempted();
      
      if (! $checkStatus->isActivate())
      {
         return redirect('login')->with('message','User is deactivated');
      }
      return $next($request);
   }
}
