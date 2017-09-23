<?php
/**
 * Created by PhpStorm.
 * User: ZJM
 * Date: 2017/9/18
 * Time: 17:29
 */
namespace App\Http\Controllers;

use App\utils\Code;
use App\utils\Data;
use App\utils\Res;
use App\Model\Reviewer;
use Illuminate\Http\Request;
use Mockery\Exception;

class ReviewController extends Controller {

	public function login(Request $request) {
		if($request->isMethod('post')) {
			$number = $request->input('number');
			$password = $request->input('password');
			$res = Reviewer::where('number',$number)
			               ->where('password', $password)
			               ->first();
			if($res != null)
				return redirect('reviewer/apply_admin');
			return redirect()->back()->withInput()->with('error','工号或密码错误');
		}
		return view( 'reviewer.login');
	}

	public function apply_admin(Request $request) {
		return view('reviewer.apply_admin');
	}

	public function draft_admin(Request $request) {
		return view('reviewer.draft_admin');
	}

	public function reviewer_admin(Request $request) {
		return view('reviewer.reviewer_admin');
	}

	public function get_all_reviewers() {
		$reviews = Reviewer::where('role',0)->get();
		$data = new Data();
		$data->setData($reviews);
		return response()->json($data);
	}
	public function download(Request $request, $filename) {
		echo $filename;
		$id = session()->get('proposer')->id;
		/*$upload_path = config('filesystems.disks.uploads.root').'\\'.$id.'\\'.$filename;
		$full_path = $upload_path.'.doc';
		echo $full_path.'<br>';*/
		/*if(!file_exists($full_path)) {
			$full_path = $upload_path.'.docs';
		}
		echo $full_path.'<br>';
		if(!file_exists($full_path)) {
			exit('文件不存在！');
		}*/
		return response()->download(storage_path('app\uploads\\'.$id).'\\'.$filename.'.doc','真名.doc');
	}

	public function delete_reviewer(Request $request) {
		$res = new Res(Code::success,'删除成功');
		try {
			Reviewer::destroy($request->id);
		}
		catch(Exception $e) {
			$res = new Res(Code::error,'删除失败，该审议人存在未完成的审议任务');
		}
		return response()->json($res);
	}

	public function add_reviewer(Request $request) {
		$res = new Res(Code::success,'');
		if(Reviewer::where('number',$request->number)->count() == 1) {
			$res->setCode(Code::error);
			$res->setMsg('创建失败：该工号已存在');
			return response()->json($res);
		}
		try {
			Reviewer::create($request->all());
		}
		catch(Exception $e) {
			$res->setCode(Code::error);
			$res->setMsg('创建失败');
			return response()->json($res);
		}
		$res->setMsg('创建审议人'.$request->number.'   '.$request->name.'成功');
		return response()->json($res);
	}
}