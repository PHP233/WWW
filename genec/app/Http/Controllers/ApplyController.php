<?php
/**
 * Created by PhpStorm.
 * User: ZJM
 * Date: 2017/9/24
 * Time: 21:10
 */

namespace App\Http\Controllers;


use App\Model\Apply;
use App\Model\Reviewer;
use App\Model\Suggest;
use Illuminate\Contracts\Validation\UnauthorizedException;
use Illuminate\Http\Request;

class ApplyController extends Controller {

	public function index(Request $request) {
		$checkers = Reviewer::where('role',0)->get();
		$applies = Apply::all();
		return view('reviewer.apply_admin',[
			'applies' => $applies,
			'checkers' => $checkers,
		]);
	}

	/*
	 * 下载申请书
	 */
	public function download(Request $request, $id, $modify_time) {
		$reviewer = session('reviewer');
		$apply = Apply::find($id);
		if(!isset($apply)) {
			exit('无此申请书');  // 如果无申请书 id，不向下进行
		}
		if($reviewer->role == 0) {
			// 判断有没有符合审议人审议的申请书
			$num = Suggest::where('apply_id',$id)
			       ->where('reviewer_id',$reviewer->id)
			       ->where('modify_time',$modify_time)
			       ->count();
			if($num == 0) {
				exit('无下载权限');
			}
		}
		if($modify_time < $apply->modify_time) {
			$apply->title = str_replace_last('.doc','_第'.$modify_time.'版.doc', $apply->title);
		}
		return response()->download(storage_path('app/uploads/apply/'.$apply->proposer_id.'/'.$modify_time.'/'.$id), $apply->title, ['application/msword']);
	}
}