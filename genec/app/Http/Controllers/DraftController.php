<?php
/**
 * Created by PhpStorm.
 * User: ZJM
 * Date: 2017/9/25
 * Time: 15:01
 */

namespace App\Http\Controllers;


use App\Model\Apply;
use App\Model\Draft;
use App\Model\Reviewer;
use App\Model\Suggest;
use App\utils\Code;
use App\utils\Res;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class DraftController extends Controller {

	// 返回所有送审表
	public function index(Request $request) {
		$reviewer = session('reviewer');
        //$drafts = Draft::leftJoin('apply','draft.apply_id','=', 'apply.id')->whereRaw('apply.reviewer_id='.$reviewer->id)->get();
        $drafts = Draft::leftJoin('apply','draft.apply_id','=', 'apply.id')
                       ->whereRaw('apply.reviewer_id='.$reviewer->id)
                       ->select('draft.*')
                       ->with('apply')
                       ->get();
        $checkers = Reviewer::where('role',0)->get();
        return view('reviewer.draft_admin',[
        	'drafts' => $drafts,
	        'checkers' => $checkers,
        ]);
	}

	/*
	 * 跳转到审批人上传送审表的页面
	 */
	public function to_draft_upload() {
		$reviewer = session('reviewer');
		// 获取通过审批的申请书或送审表未通过审批的申请书
		$applies = Apply::where('state',Apply::PASS)
		                ->orWhere('state',Apply::DRAFT_UPLOAD)
						->where('reviewer_id',$reviewer->id)
		                ->get();
		return view('reviewer.upload_draft',[
			'applies' => $applies,
		]);
	}

	/*
	 * 审批人上传送审表
	 */
	public function upload(Request $request) {
		if(!$request->hasFile('file')) {
			exit('上传文件为空！');
		}
		$file = $request->file('file');
		if(!$file->isValid()) {
			exit('文件上传出错！');
		}
		$ext = $file->getClientOriginalExtension();
		$title = $file->getClientOriginalName();
		if($ext!='doc' && $ext != 'docx') {
			exit('文件类型必须是doc或docx');
		}
		$draft = Draft::where('apply_id',$request->apply_id)->first();
		// 如果没有该申请的送审表，则新建
		if($draft == null) {
			$draft = Draft::create([
				'apply_id' => $request->apply_id,
				'title' => $title,
				'modify_time' => 0,
			]);
			Apply::find($request->apply_id)->update([
				'state' => Apply::DRAFT_UPLOAD
			]);
		} else {
			// 有该申请的送审表，判断送审表状态，如果是3 即未通过审批，则将送审表modify_time + 1，修改状态为 0
			if($draft->state == Draft::NO_PASS) {
				$draft->update([
					'modify_time' => $draft->modify_time + 1,
					'title' => $title,
					'state' => Draft::NO_ASSIGN_WAIT_REVIEW
				]);
			}
			else if($draft->state == Draft::NO_ASSIGN_WAIT_REVIEW){
				// 状态为 0 即未分配
				$draft->update([
					'title' => $title,
				]);
			}
		}
		// 设置上传文件名:为新增申请记录的id
		$upload_path = config('filesystems.disks.draft_uploads.root').'/'.$draft->modify_time;
		if (!is_dir($upload_path)) {
			mkdir($upload_path,0777,true);
		}
		if(!$file->move($upload_path,$draft->id)) {
			return back()->with('sign','保存文件失败！');
		}
		return back()->with('sign','上传成功！');
	}

	// 下载送审表
	public function download(Request $request, $id, $modify_time) {
		$reviewer = session('reviewer');
		$draft = Draft::find($request->id);
		if(!isset($draft)) {
			exit('无此送审表');
		}
		if($reviewer->role == 0) {
			// 判断有没有符合审议人审议的送审表，没有提示
			$num = Suggest::where('draft_id',$id)
				->where('reviewer_id',$reviewer->id)
				->where('modify_time',$draft->modify_time)
				->count();
			if($num == 0) {
				exit('无下载权限');
			}
		}
		if($modify_time < $draft->modify_time) {
			$draft->title = str_replace_last('.doc','_第'.$modify_time.'版.doc',$draft->title);
		}
		return response()->download(storage_path('app/uploads/draft/'.$modify_time.'/'.$id), $draft->title, ['application/msword']);
	}

}