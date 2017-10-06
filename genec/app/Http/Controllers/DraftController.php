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
use App\utils\Code;
use App\utils\Res;
use Illuminate\Http\Request;

class DraftController extends Controller {

	// 返回所有送审表
	public function index(Request $request) {
        $drafts = Draft::all();
        $checkers = Reviewer::where('role',0)->get();
        return view('reviewer.draft_admin',[
        	'drafts' => $drafts,
	        'checkers' => $checkers,
        ]);
	}

	public function upload(Request $request) {
		$applies = Apply::where('state', Apply::PASS)->get();
		if($request->isMethod('post')) {
			if(!$request->hasFile('draft')) {
				exit('上传文件为空！');
			}
			$file = $request->file('draft');
			if(!$file->isValid()) {
				exit('文件上传出错！');
			}
			$ext = $file->getClientOriginalExtension();
			if($ext!='doc' && $ext != 'docx') {
				exit('文件类型必须是doc或docx');
			}
			$draft = Draft::where('apply_id',$request->apply_id)->first();
			if($draft == null) {
				Draft::create([
					'apply_id' => $request->apply_id,
					'title' => $request->title.'.'.$ext,
				]);
			} else {
				$draft->update([
					'title' => $request->title.'.'.$ext,
				]);
			}
			// 设置上传文件名:为新增申请记录的id
			$upload_path = config('filesystems.disks.draft_uploads.root').'/';
			if (!file_exists($upload_path)) {
				mkdir($upload_path);
			}
			if(!$file->move($upload_path,$draft->id)) {
				return back()->with('sign','保存文件失败！');
			}
			return back()->with('sign','上传成功！');
		}
		return view('reviewer.upload_draft',[
			'applies' => $applies,
		]);
	}

	// 下载送审表
	public function download(Request $request) {
		$draft = Draft::find($request->id);
		return response()->download(storage_path('app\uploads\draft\\'.$request->id), $draft->title, ['application/msword']);
	}

	// 查看申请书是否已经上传过送审表
	public function isHasDraft(Request $request) {
		$res = new Res(Code::success,'');
		$draft = Draft::where('apply_id',$request->apply_id)->first();
		if($draft == null) {
			$res->setCode(Code::error);
			$res->setMsg('没有上传送审表记录');
		} else {
			$res->setMsg('已经上传过送审表：'.$draft->title);
		}
		return response()->json($res);
	}
}