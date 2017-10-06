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
use Illuminate\Support\Facades\DB;

class CheckerController extends Controller {

	public function index() {
		return view('checker.apply_checker');
	}

	public function toDraft() {
		return view('checker.draft_checker');
	}

	// 获取还未被审批的文件：state为 1 或 2
	public function get_my_apply($type = 0) {
		$reviewer_id = session()->get('reviewer')->id;
		if(!$type) {
			$res = Reviewer::find($reviewer_id)
			               ->applies()
				           ->where('state','>',Apply::NO_ASSIGN_WAIT_REVIEW)
				           ->where('state','<',Apply::NO_PASS)
				           ->whereRaw('apply.modify_time = suggest.modify_time')
				           ->get();
		} else {
			$res = Reviewer::find($reviewer_id)
			               ->drafts()
				           ->where('state','>',Apply::NO_ASSIGN_WAIT_REVIEW)
				           ->where('state','<',Apply::NO_PASS)
				           ->whereRaw('draft.modify_time = suggest.modify_time')
				           ->get();
		}
		$data = new Data();
		$data->setData($res);
		return response()->json($data);
	}

	// 提交审议结果
	public function suggest(Request $request) {
		$reviewer_id = session()->get('reviewer')->id;
		$apply_id = $request->apply_id;
		$res = new Res(Code::success, '提交审议意见成功！');
		DB::transaction(function() use($apply_id, $request, $reviewer_id, $res) {
			if($apply_id != null) {
				$r = Suggest::where('apply_id',$apply_id)
				            ->where('reviewer_id',$reviewer_id)
				            ->where('modify_time',$request->modify_time)
				            ->update(['content' => $request->suggest]);
				// 获取 apply_id 没有审议的审议数目
				$no_review = Suggest::where('apply_id',$apply_id)
				                    ->where('modify_time',$request->modify_time)
				                    ->where('content',null)->count();
				// 如果都审议了，更改申请书状态为 已审议，待审批
				if($no_review == 0) {
					Apply::find($request->apply_id)->update(['state' => Apply::WAIT_PASS]);
				}
			} else {
				$r = Suggest::where('draft_id',$request->draft_id)
				            ->where('reviewer_id',$reviewer_id)
				            ->where('modify_time',$request->modify_time)
				            ->update(['content' => $request->suggest]);
				// 获取 draft_id 没有审议的审议数目
				$no_review = Suggest::where('draft_id',$request->draft_id)
				                    ->where('modify_time',$request->modify_time)
				                    ->where('content',null)->count();
				// 如果都审议了，更改申请书状态为 已审议，待审批
				if($no_review == 0) {
					Apply::find($request->draft_id)->update(['state' => Apply::WAIT_PASS]);
				}
			}
			if(!$r) {
				$res->setCode(Code::error);
				$res->setMsg('提交审议意见失败，请重试！');
			}
		});
		return response()->json($res);
	}

	public function record(Request $request) {
		$reviewer_id = session()->get('reviewer')->id;
		$apply_id = $request->apply_id;
		$res = new Res(Code::success,'你之前曾经审议过：');
		if($apply_id != null) {
			$suggests = Suggest::where('apply_id',$apply_id)
			                   ->where('reviewer_id',$reviewer_id)
			                   ->where('modify_time','<',$request->modify_time)
			                   ->orderBy('updated_at')
			                   ->get();
		} else {
			$suggests = Suggest::where('draft_id',$request->draft_id)
			                   ->where('reviewer_id',$reviewer_id)
			                   ->where('modify_time','<',$request->modify_time)
			                   ->orderBy('updated_at')
			                   ->get();
		}
		if(count($suggests) == 0) {
			$res->setMsg('没有之前的审议记录');
		}
		$res->setReply($suggests);
		return response()->json($res);
	}

}