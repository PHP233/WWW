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

	// 获取还未被审批的文件：state为 1 或 2
	public function get_my_apply() {
		$reviewer_id = session()->get('reviewer')->id;
		$applies = Reviewer::find($reviewer_id)
		                   ->applies()
		                   ->where('state','>',Apply::NO_ASSIGN_WAIT_REVIEW)
		                   ->where('state','<',Apply::NO_PASS)
		                   ->whereRaw('apply.modify_time = suggest.modify_time')
		                   ->get();
		$data = new Data();
		$data->setData($applies);
		return response()->json($data);
	}

	// 提交审议结果
	public function suggest(Request $request) {
		$reviewer_id = session()->get('reviewer')->id;
		$r = Suggest::where('apply_id',$request->apply_id)
			->where('reviewer_id',$reviewer_id)
			->where('modify_time',$request->modify_time)
		     ->update(['content' => $request->suggest]);
		// 获取 apply_id 没有审议的审议数目
		$no_review = Suggest::where('apply_id',$request->apply_id)
			->where('content',null)->count();
		// 如果都审议了，更改申请书状态为 已审议，待审批
		if($no_review == 0) {
			Apply::find($request->apply_id)->update(['state' => Apply::WAIT_PASS]);
		}
		if(!$r) {
			return response()->json(new Res(Code::error, '提交审议意见失败，请重新提交！'));
		}
		return response()->json(new Res(Code::success, '提交审议意见成功！'));
	}

	public function record(Request $request) {
		$reviewer_id = session()->get('reviewer')->id;
		$res = new Res(Code::success,'你之前曾经审议过：');
		$suggests = Suggest::where('apply_id',$request->apply_id)
		        ->where('reviewer_id',$reviewer_id)
		        ->where('modify_time','<',$request->modify_time)
				->orderBy('updated_at')
				->get();
		if(count($suggests) == 0) {
			$res->setMsg('没有之前的审议记录');
		}
		$res->setReply($suggests);
		return response()->json($res);
	}

}