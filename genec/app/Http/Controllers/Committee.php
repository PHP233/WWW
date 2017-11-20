<?php
/**
 * Created by PhpStorm.
 * User: ZJM
 * Date: 2017/11/20
 * Time: 12:49
 */

namespace App\Http\Controllers;
use App\utils\Code;
use App\utils\Res;
use App\Model\Reviewer;
use App\utils\SendEmail;
use Illuminate\Http\Request;


/*
 * 组委会成员共同操作
 */
class Committee extends Controller {

	/*
	 * 登录
	 */
	public function login(Request $request) {
		if($request->isMethod('post')) {
			$number = $request->input('number');
			$password = $request->input('password');
			$res = Reviewer::where('number',$number)
			               ->where('password', $password)
			               ->first();
			if($res != null) {
				session()->put(['reviewer' => $res]);
				if($res->role == Reviewer::REVIEWER) {
					return redirect()->route('apply::index');
				} else if($res->role == Reviewer::ADMIN) {
					return redirect()->route('admin::index');
				}
				return redirect()->route('checker::index');
			}
			return redirect()->back()->withInput()->with('error','工号或密码错误');
		}
		return view( 'reviewer.login');
	}

	// 登出
	public function logout() {
		session()->flush();
		return redirect('reviewer/login');
	}

	// 修改个人信息
	public function updateInfo(Request $request) {
		$res = new Res(Code::success,'');
		$reviewer = session('reviewer');
		$reviewer->name = $request->name;
		$reviewer->phone = $request->phone;
		$reviewer->email = $request->email;
		$isExist = Reviewer::where('email',$request->email)->where('id','!=',$reviewer->id)->count();
		if($isExist) {
			$res->setCode(Code::error);
			$res->setMsg('该邮箱存在其他人使用');
			return response()->json($res);
		}
		$reviewer->save();
		session()->put('reviewer',$reviewer);
		$res->setMsg('更新个人信息成功！');
		$res->setReply($reviewer);
		return response()->json($res);
	}

	// 修改密码
	public function changePwd(Request $request) {
		$reviewer = session('reviewer');
		if($reviewer->password != $request->pwd0) {
			$res = new Res(Code::error,'原密码错误！');
			return response()->json($res);
		}
		$reviewer->password = $request->pwd1;
		$reviewer->save();
		session()->flush();
		return response()->json(new Res(Code::success,''));
	}

	/*
	 * 发送重置密码的链接
	 */
	public function sendResetPasswordEmail(Request $request) {
		$email = $request->email;
		// 发送验证邮箱的链接
		$reviewer = Reviewer::where('email',$email)->first();
		if(!isset($reviewer)) {
			return redirect()->back()->withInput()->with('error','邮箱不存在！');
		}
		$activeCode = Code::randomCode();
		$newPassword = Code::getNewPassword();     // 新密码
		$reviewer->activeCode = $activeCode;
		$reviewer->save();
		SendEmail::resetPassword($newPassword, $activeCode, route('resetPassword',
			['$reviewer_id' => $reviewer->id, 'newPassword' => $newPassword]), $email);
		return redirect()->back()->with('error','新密码已发送至您的邮箱');
	}


	/*
	 * 重置密码
	 */
	public function resetPassword(Request $request, $reviewer_id, $newPassword, $activeCode) {
		$reviewer = Reviewer::where('id', $reviewer_id)->where('activeCode', $activeCode)->first();
		if($reviewer == null) {
			exit('验证链接错误');
		}
		$reviewer->password = $newPassword;
		$reviewer->save();
		return view('reviewer.resetPassword_success');
	}

}