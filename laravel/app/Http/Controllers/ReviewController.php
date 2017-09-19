<?php
/**
 * Created by PhpStorm.
 * User: ZJM
 * Date: 2017/9/18
 * Time: 17:29
 */
namespace App\Http\Controllers;

use App\Reviewer;
use Illuminate\Http\Request;

class ReviewController extends Controller {

	public function login(Request $request) {
		if($request->isMethod('post')) {
			$number = $request->input('number');
			$password = $request->input('password');
			$res = Reviewer::where('number',$number)
			               ->where('password', $password)
			               ->first();
			if($res != null)
				return redirect('reviewer/admin');
			return redirect()->back()->withInput()->with('error','工号或密码错误');
		}
		return view( 'reviewer.login');
	}

	public function admin(Request $request) {
		return view('reviewer.admin');
	}
}