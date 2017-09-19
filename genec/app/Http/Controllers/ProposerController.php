<?php
/**
 * Created by PhpStorm.
 * User: ZJM
 * Date: 2017/9/19
 * Time: 9:54
 */

namespace App\Http\Controllers;
use App\Model\Proposer;
use \Illuminate\Http\Request;

class ProposerController extends Controller {
	public function register(Request $request) {
		if($request->isMethod('post')) {
			$register = $request->all();
			array_shift($register);
			Proposer::create($register);
			return redirect('proposer');
		}
		return view('proposer/register');
	}

	public function login(Request $request) {
		if($request->isMethod('post')) {
			$email = $request->email;
			$password = $request->password;
			$proposer = Proposer::where('email',$email)
			                    ->where('password',$password)
								->first();
			if($proposer == null) {
				return redirect()->back()->withInput()->with('error','邮箱或密码错误');
			}
			// 获取申报人所有申报的项目
			$applies = $proposer->applies;
			usort($applies->items,"sort_by_created_at");
			session()->put('applies',$applies);
			session()->put('proposer',$proposer);
			return redirect('proposer');
		}
		return view('proposer/login');
	}

	public function update(Request $request) {
		$proposer = session()->get('proposer');
		$proposer->name = $request->name;
		$proposer->phone = $request->phone;
		$proposer->save();
	}

	public function index(Request $request) {
		return view('proposer/index');
	}

	public function logout(Request $request) {
		session()->flush();
		return redirect('proposer/login');
	}

	private function sort_by_created_at($a, $b) {
		return ($a->created_at < $b->created_at) ? -1: 1;
	}

}