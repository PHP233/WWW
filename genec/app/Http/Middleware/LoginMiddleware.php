<?php
/**
 * Created by PhpStorm.
 * User: ZJM
 * Date: 2017/10/6
 * Time: 22:28
 */

namespace App\Http\Middleware;

use Closure;

class LoginMiddleware {

	public function handle($request, Closure $next) {
		if(!session('reviewer')) {
			return redirect('reviewer/login');
		}
		return $next($request);
	}

}