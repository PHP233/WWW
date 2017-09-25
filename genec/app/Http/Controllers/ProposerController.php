<?php
/**
 * Created by PhpStorm.
 * User: ZJM
 * Date: 2017/9/19
 * Time: 9:54
 *  Description: 申请人控制器
 */

namespace App\Http\Controllers;
use App\Model\Apply;
use App\Model\Proposer;
use App\utils\Code;
use \Illuminate\Http\Request;

class ProposerController extends Controller {
	public function register(Request $request) {
		if($request->isMethod('post')) {
			$register = $request->all();
			array_shift($register);
			Proposer::create($register);
			return redirect('proposer');
		}
		return view('proposer/register');
	}

	public function login(Request $request) {
		if($request->isMethod('post')) {
			$email = $request->email;
			$password = $request->password;
			$proposer = Proposer::where('email',$email)
			                    ->where('password',$password)
								->first();
			if($proposer == null) {
				return redirect()->back()->withInput()->with('error','邮箱或密码错误');
			}
			// 获取申报人所有申报的项目
			session()->put('proposer',$proposer);
			return redirect('proposer');
		}
		return view('proposer/login');
	}

	public function update(Request $request) {
		$proposer = session()->get('proposer');
		$proposer->name = $request->name;
		$proposer->phone = $request->phone;
		$proposer->save();
	}

	public function index(Request $request, $id = null) {
		$proposer = session()->get('proposer');
		$applies = $proposer->applies()->orderBy('created_at','desc')->get();
		session()->put('applies',$applies);
		if (!isset($id)) {
			return view('proposer/index', [
				'show_apply' => $applies->first()
			]);
		}
		for($i=0; $i<count($applies); $i++) {
			if($applies[$i]->id == $id) {
				$show_apply = $applies[$i];
			}
		}
		return view('proposer/index',[
			'show_apply'=> $show_apply,
		]);
	}

	public function add_apply(Request $request) {
		$id = session()->get('proposer')->id;
		if ($request->isMethod('post')) {
			$title = $request->title;
			if(!$request->hasFile('apply')) {
				exit('上传文件为空！');
			}
			$file = $request->file('apply');
			if(!$file->isValid()) {
				exit('文件上传出错！');
			}
			$ext = $file->getClientOriginalExtension();
			if($ext!='doc' && $ext != 'docx') {
				exit('文件类型必须是doc或docx');
			}
			// 设置上传文件名:为新增申请记录的id
			$apply = $this->insert_apply($id, $title,$ext);
			$upload_path = config('filesystems.disks.apply_uploads.root').'/'.$id;
			if (!file_exists($upload_path)) {
				mkdir($upload_path);
			}
			if(!$file->move($upload_path,$apply->id)) {
				exit('保存文件失败！');
			}
			return redirect()->back();
		}
		return view('proposer/add_apply');
	}

	public function logout() {
		session()->flush();
		return redirect('proposer/login');
	}

	protected function insert_apply($p_id, $title, $ext) {
		$apply = new Apply();
		$apply->proposer_id = $p_id;
		$apply->title = $title.$ext;
		$apply->save();
		return $apply;
	}

}