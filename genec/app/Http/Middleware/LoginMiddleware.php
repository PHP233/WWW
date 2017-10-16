<?php
/**
 * Created by PhpStorm.
 * User: ZJM
 * Date: 2017/10/6
 * Time: 22:28
 */

namespace App\Http\Middleware;

use App\Http\Requests\Request;
use Closure;

class LoginMiddleware {

	/*
	 * 登录控制器：如果没有登录进行登录
	 */
	public function handle($request, Closure $next) {
		if($request->is('wordpress/*') || $request->is('wordpress')) {
			return $next($request);
		}
		if($request->is('reviewer/*')) {
			if(!session('reviewer')) {
				return redirect()->route('reviewer_login');
			}
		} else if($request->is('proposer') || $request->is('proposer/*')) {
			if(!session('proposer')) {
				return redirect()->route('proposer_login');
			}
		}
		return $next($request);
	}

}