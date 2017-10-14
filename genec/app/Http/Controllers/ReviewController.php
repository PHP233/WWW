<?php
/**
 * Created by PhpStorm.
 * User: ZJM
 * Date: 2017/9/18
 * Time: 17:29
 */
namespace App\Http\Controllers;

use App\Model\Apply;
use App\Model\Draft;
use App\Model\Suggest;
use App\utils\Code;
use App\utils\Data;
use App\utils\Res;
use App\Model\Reviewer;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Mockery\Exception;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller {

	public function login(Request $request) {
		if($request->isMethod('post')) {
			$number = $request->input('number');
			$password = $request->input('password');
			$res = Reviewer::where('number',$number)
			               ->where('password', $password)
			               ->first();
			if($res != null) {
				session()->put(['reviewer' => $res]);
				if($res->role)
					return redirect('reviewer/apply');
				return redirect('reviewer/checker');
			}
			return redirect()->back()->withInput()->with('error','工号或密码错误');
		}
		return view( 'reviewer.login');
	}

	public function draft_admin(Request $request) {
		return view('reviewer.draft_admin');
	}

	public function reviewer_admin(Request $request) {
		return view('reviewer.reviewer_admin');
	}

	/*
	 * 获取所有审议人
	 */
	public function get_all_reviewers() {
		$reviews = Reviewer::where('role',Reviewer::CHECKER)->get();
		$data = new Data();
		$data->setData($reviews);
		return response()->json($data);
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
		$res->setMsg('创建审议人'.$request->number.'   '.$request->name.'成功');
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
	 *  分配审议任务,记录是第几次的审议结果
	 */
	public function assign(Request $request) {
		$res = new Res(Code::success, '');
		DB::transaction(function () use($request, $res){
			$apply_id = $request->apply_id;
			$checker_ids = $request->checker_ids;
			try{
				// 有两种可能：申请书 或 送审表
				if($apply_id != null) {
					$apply = Apply::find($apply_id);
					$res->setReply($apply);
					foreach ($checker_ids as $checker_id) {
						Suggest::create([
							'apply_id' => $apply_id,
							'reviewer_id' => $checker_id,
							'modify_time' => $apply->modify_time,
						]);
					}
					$res->setMsg($apply->title.'——审议任务已分配');
					$apply->state = Apply::ASSIGN_WAIT_REVIEW;
					$apply->save();
				} else {
					$draft_id = $request->draft_id;
					$draft = Draft::find($draft_id);
					$res->setReply($draft);
					foreach ($checker_ids as $checker_id) {
						Suggest::create([
							'draft_id' => $draft_id,
							'reviewer_id' => $checker_id,
							'modify_time' => $draft->modify_time,
						]);
					}
					$res->setMsg($draft->title.'——审议任务已分配');
					$draft->update(['state'=>Draft::ASSIGN_WAIT_REVIEW]);
				}
			} catch (QueryException $e) {
				$res->setCode(Code::error);
				$res->setMsg('分配任务出现错误...');
			}
		});
		return response()->json($res);
	}

	/*
	 * 审批
	 */
	public function passOrFail(Request $request) {
		$reviewer_id = session()->get('reviewer')->id;
		$res = new Res(Code::success, '审批完成');
		$isPass = $request->isPass; // 1 通过 0 不通过
		// 两种情况：申请书或送审表的判断
		if ($request->apply_id != null) {
			$apply = Apply::find($request->apply_id);
			if($isPass) {
				$apply->update(['state' => Apply::PASS]);
			} else {
				$apply->update(['state' => Apply::NO_PASS]);
			}
			Suggest::create([
				'apply_id' => $request->apply_id,
				'reviewer_id' => $reviewer_id,
				'content' => $request->m_content,
				'modify_time' => $apply->modify_time,
			]);
		} else {
			$draft = Draft::find($request->draft_id);
			if($isPass) {
				$draft->update(['state' => Apply::PASS]);
				Apply::find($draft->apply_id)->update([
					'state' => Apply::DRAFT_PASS
				]);
			} else {
				$draft->update(['state' => Apply::NO_PASS]);
			}
			Suggest::create([
				'draft_id' => $request->draft_id,
				'reviewer_id' => $reviewer_id,
				'content' => $request->m_content,
				'modify_time' => $draft->modify_time,
			]);
			$res->setReply($draft);
		}
		return response()->json($res);
	}

	// 获取所有审议结果
	public function get_review_list(Request $request) {
		$modify_time = $request->modify_time;
		$arr = [];
		// 判断两种情况：申请书 或 送审表
		if($request->apply_id != null) {
			for($i=0;$i<=$modify_time;$i++) {
				$arr[$i] = Suggest::with('reviewer')
				                  ->where('apply_id',$request->apply_id)
				                  ->where('modify_time',$i)
				                  ->get();
			}
		} else {
			for($i=0;$i<=$modify_time;$i++) {
				$arr[$i] = Suggest::with('reviewer')
				                  ->where('draft_id',$request->draft_id)
				                  ->where('modify_time',$i)
				                  ->get();
			}
		}
		return response()->json($arr);
	}

	// 出版
	public function publish(Request $request) {
		DB::transaction(function () use ($request){
			$draft = Draft::find($request->id);
			$draft->update([
				'state' => Draft::PUBLISH
			]);
			Apply::find($draft->apply_id)->update([
				'state' => Apply::PUBLISH
			]);
		});
		$res = new Res(Code::success,'该项目出版成功！');
		return response()->json($res);
	}

	//撤销项目
	public function dropProject(Request $request) {
		if($request->password != session('reviewer')->password) {
			return response()->json(new Res(Code::error,'密码错误！无法撤销该项目！'));
		}
		DB::transaction(function() use($request){
			$draft = Draft::find($request->id);
			$draft->update([
				'state' => Draft::DROPPED
			]);
			Apply::find($draft->apply_id)->update([
				'state' => Apply::DROPPED
			]);
		});
		return response()->json(new Res(Code::success,'该项目已撤销！'));
	}

	// 登出
	public function logout() {
		session()->flush();
		return redirect('reviewer/login');
	}

	// 修改个人信息
	public function updateInfo(Request $request) {
		$reviewer = session('reviewer');
		$reviewer->name = $request->name;
		$reviewer->phone = $request->phone;
		$reviewer->email = $request->email;
		$reviewer->save();
		session()->put('reviewer',$reviewer);
		$res = new Res(Code::success,'更新个人信息成功！');
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
}