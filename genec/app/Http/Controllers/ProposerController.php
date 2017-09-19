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
			$applies = $proposer->applies()->orderBy('created_at','desc')->get();
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

	public function index(Request $request, $id = null) {
		$applies = session()->get('applies');
		if (!isset($id)) {
			return view('proposer/index', [
				'show_apply' => $applies->first()
			]);
		}
		for($i=0; $i<count($applies); $i++) {
			if($applies[$i]->id == $id) {
				$show_apply = $applies[$i];
			}
		}
		return view('proposer/index',[
			'show_apply'=> $show_apply,
		]);
	}

	public function add_apply(Request $request) {
		return view('proposer/add_apply');
	}

	public function logout(Request $request) {
		session()->flush();
		return redirect('proposer/login');
	}

}