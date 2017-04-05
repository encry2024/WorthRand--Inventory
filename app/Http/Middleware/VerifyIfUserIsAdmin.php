<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Contracts\Auth\Guard;

class VerifyIfUserIsAdmin
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
   public function handle($request, Closure $next, $guard = null)
   {
      if (Auth::guard($guard)->guest()) {
         if ($request->ajax() || $request->wantsJson()) {
            return response('Unauthorized.', 401);
         } else {
            return redirect()->guest('login');
         }
      } else if ($this->auth->user()->role != 'admin') {
         abort(403, 'Unauthorized action.');
      }

      return $next($request);
   }
}
