<?php
/**
 * Created by PhpStorm.
 * User: ZJM
 * Date: 2017/9/28
 * Time: 15:35
 */

namespace App\Http\Controllers;


use App\Model\Apply;
use App\Model\Suggest;
use App\utils\Code;
use App\utils\Res;
use Illuminate\Http\Request;
use App\Model\Reviewer;
use App\utils\Data;
use Mockery\Exception;

class CheckerController extends Controller {

	public function index() {
		return view('checker.apply_checker');
	}

	public function get_my_apply() {
		$reviewer_id = session()->get('reviewer')->id;
		$applies = Reviewer::find($reviewer_id)
		                   ->applies()
		                   ->where('state','>',0)
		                   ->where('state','<',3)
		                   ->get();
		$data = new Data();
		$data->setData($applies);
		return response()->json($data);
	}

	public function suggest(Request $request) {
		$reviewer_id = session()->get('reviewer')->id;
		$r = Suggest::where('apply_id',$request->apply_id)
			->where('reviewer_id',$reviewer_id)
		     ->update(['content' => $request->suggest]);
		// 获取 apply_id 没有审议的审议数目
		$no_review = Suggest::where('apply_id',$request->apply_id)
			->where('content',null)->count();
		// 如果都审议了，更改申请书状态为 已审议，待审批
		if($no_review == 0) {
			Apply::find($request->apply_id)->update(['state' => 2]);
		}
		if(!$r) {
			return response()->json(new Res(Code::error, '提交审议意见失败，请重新提交！'));
		}
		return response()->json(new Res(Code::success, '提交审议意见成功！'));
	}
}