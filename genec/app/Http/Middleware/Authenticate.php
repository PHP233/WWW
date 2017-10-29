<?php

namespace App\Http\Middleware;

use App\Model\Reviewer;
use Closure;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        /*if (Auth::guard($guard)->guest()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('login');
            }
        }*/

        if($request->is('admin') || $request->is('admin/*')) {
        	if(session('reviewer')->role != Reviewer::ADMIN) {
		        return response('无此操作权限', 401);
	        }
        }
        else if(!$request->is('reviewer/checker') && !$request->is('reviewer/checker/*') && !$request->is('proposer') && !$request->is('proposer/*')) {
        	if (session( 'reviewer' )->role != Reviewer::REVIEWER ) {
			    return response('无此操作权限', 401);
		    }
	    }
        return $next($request);
    }
}
