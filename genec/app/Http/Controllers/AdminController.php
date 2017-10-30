<?php
/**
 * Created by PhpStorm.
 * User: ZJM
 * Date: 2017/10/29
 * Time: 17:22
 */

namespace App\Http\Controllers;


use App\Model\Apply;
use App\Model\Reviewer;
use App\utils\Data;
use App\utils\Code;
use App\utils\Res;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use \Exception;

class AdminController extends Controller  {

	public function reviewer_admin() {
		return view('admin.reviewer_admin');
	}

	/*
	 * interface:
	 */
	public function get_all_reviewers() {
		$reviews = Reviewer::where('role',Reviewer::CHECKER)
		                   ->orWhere('role',Reviewer::REVIEWER)
		                   ->get();
		$data = new Data();
		$data->setData($reviews);
		return response()->json($data);
	}

	/*
	 * 登陆默认页面
	 */
	public function index() {
		$applies = Apply::all();
		$reviewers = Reviewer::where('role',Reviewer::REVIEWER)->get();
		return view('admin.assign',[
			'applies' => $applies,
			'reviewers' => $reviewers,
		]);
	}

	/*
	 * 删除审议人
	 */
	public function delete_reviewer(Request $request) {
		$res = new Res(Code::success,'删除成功');
		try {
			Reviewer::destroy($request->id);
		}
		catch(QueryException $e) {
			$res = new Res(Code::error,'删除失败，该审议人存在未完成的审议任务');
		}
		return response()->json($res);
	}

	/*
	 * 创建审议人
	 */
	public function add_reviewer(Request $request) {
		$res = new Res(Code::success,'');
		if(Reviewer::where('number',$request->number)->count() == 1) {
			$res->setCode(Code::error);
			$res->setMsg('创建失败：该工号已存在');
			return response()->json($res);
		}
		try {
			$reviewer = Reviewer::create($request->all());
		}
		catch(Exception $e) {
			$res->setCode(Code::error);
			$res->setMsg('创建失败');
			return response()->json($res);
		}
		if($request->role)
			$role = '创建审批人';
		else
			$role = '创建审议人';
		$res->setMsg($role.$request->number.'   '.$request->name.'成功');
		$reviewer->setPhoneAndEmail();
		$res->setReply($reviewer);
		return response()->json($res);
	}

	/*
	 * 修改审议人信息
	 */
	public function edit_reviewer(Request $request) {
		$res = new Res(Code::success,'修改信息成功');
		$reviewer = Reviewer::find($request->id);
		$reviewer->name = $request->name;
		$reviewer->number = $request->number;
		$reviewer->sex = $request->sex;
		if(!$reviewer->save() ) {
			$res->setCode(Code::error);
			$res->setMsg('更新审议人信息失败...');
		}
		$res->setReply($reviewer);
		return response()->json($res);
	}

	/*
	 * 分配审批负责人
	 */
	public function assign(Request $request) {
		$res = new Res(Code::success,'分配成功');
		try {
			Apply::find($request->apply_id)->update(['reviewer_id' => $request->reviewer_id]);
		}
		catch(Exception $e) {
			$res->setCode(Code::error);
			$res->setMsg('分配失败，请重试');
		}
		return response()->json($res);
	}
}