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
			$draft = new Draft();
			$draft->apply_id = $request->apply_id;
			$draft->title = $request->title.'.'.$ext;
			$bool = $draft->save();
			if(!$bool) {
				return view('reviewer.upload_draft')->with('error','新建送审表失败');
			}
			// 设置上传文件名:为新增申请记录的id
			$upload_path = config('filesystems.disks.draft_uploads.root').'/';
			if (!file_exists($upload_path)) {
				mkdir($upload_path);
			}
			if(!$file->move($upload_path,$draft->id)) {
				exit('保存文件失败！');
			}
			return redirect()->back();
		}
		return view('reviewer.upload_draft')->with('applies', $applies);
	}

	public function download(Request $request) {
		$draft = Draft::find($request->id);
		return response()->download(storage_path('app\uploads\draft\\'.$request->id), $draft->title, ['application/msword']);
	}
}