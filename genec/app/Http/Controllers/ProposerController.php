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
use App\Model\Reviewer;
use App\utils\Code;
use App\utils\Res;
use App\utils\SendEmail;
use \Illuminate\Http\Request;
use MongoDB\Driver\Exception\AuthenticationException;

class ProposerController extends Controller {
	/*
	 * 申请人注册
	 */
	public function register(Request $request) {
		if($request->isMethod('post')) {
			$register = $request->all();
			array_shift($register);
			$check = Code::checkRegistInfo($register);
			if(!$check[0]) {    // 后台检验输入信息
				return redirect()->back()->withInput()->with('error',$check[1]);
			}
			$email = Proposer::where('email',$request->email)->first();
			if(isset($email)) {   // 如果邮箱已经注册过
				var_dump($email);
				return redirect()->back()->withInput()->with('error','该邮箱已被注册');
			}
			$register["activeCode"] = md5(uniqid(md5(microtime(true)),true));
			$proposer = Proposer::create($register);
			// 发送验证邮箱的链接
			SendEmail::register(Code::call($proposer),route('emailVerification',['proposer_id'=>$proposer->id,'activeCode'=>$proposer->activeCode]),$proposer->email);
			exit('邮件已发送，请进入邮箱点击验证链接完成验证');
		}
		return view('proposer/register');
	}

	/*
	 * 邮箱验证账户激活
	 */
	public function emailVerification($proposer_id, $activeCode) {
		$proposer = Proposer::where('id',$proposer_id)
		                    ->where('activeCode',$activeCode)
							->first();
		if(!isset($proposer)) {
			exit('验证链接无效');
		}
		// var_dump($proposer->created_at);
		else if(time() - $proposer->created_at > 24*60*60) {  // 如果大于24小时失效
			Proposer::find($proposer_id)->where('state',0)->delete();
			exit('该链接已失效，请重新注册');
		}
		// 激活账号，state = 1
		$proposer->state = 1;
		$proposer->save();
		session()->put('proposer',$proposer);
		return view('proposer.verification_success');
	}

	/*
	 *  申请人登录
	 */
	public function login(Request $request) {
		if($request->isMethod('post')) {
			$email = $request->email;
			$password = $request->password;
			$proposer = Proposer::where('email',$email)
			                    ->where('password',$password)
								->where('state',1)
			                    ->first();
			if($proposer == null) {
				return redirect()->back()->withInput()->with('error','邮箱或密码错误');
			}
			// 获取申报人所有申报的项目
			session()->put('proposer',$proposer);
			return redirect()->route('proposer_index');
		}
		return view('proposer/login');
	}

	/*
	 * 申请人主页，将申请书列表显示
	 */
	public function index($id = null) {
		$proposer = session()->get('proposer');
		$applies = $proposer->applies()->orderBy('created_at','desc')->get();
		session()->put('applies',$applies);
		$show_apply = Apply::find($id);
		$isOwner = true;
		if($show_apply == null || $show_apply->proposer_id != $proposer->id) {
			$isOwner = false;
		}
		if (!isset($id) || !$isOwner) {
			return view('proposer/index', [
				'show_apply' => $applies->first()
			]);
		}
		$show_apply = Apply::find($id);
		return view('proposer/index',[
			'show_apply'=> $show_apply,
		]);
	}

	/*
	 * 上传申请书
	 */
	public function add_apply(Request $request) {
		$proposer_id = session()->get('proposer')->id;
		if ($request->isMethod('post')) {
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
			$upload_path = config('filesystems.disks.apply_uploads.root').'/'.$proposer_id.'/0';
			if (!is_dir($upload_path)) {
				mkdir($upload_path,0777,true);
			}
			// 设置上传文件名:为新增申请记录的id
			$apply = $this->insert_apply($proposer_id, $title);
			if(!$file->move($upload_path,$apply->id)) {
				exit('保存文件失败！');
			}
			return redirect()->route('proposer_index', [$apply]);
		}
		return view('proposer/add_apply');
	}

	public function logout() {
		session()->flush();
		return redirect('proposer/login');
	}

	protected function insert_apply($p_id, $title) {
		$apply = new Apply();
		$apply->proposer_id = $p_id;
		$apply->title = $title;
		$apply->save();
		return $apply;
	}

	/*
	 * 对于已经上传还没有分配审议任务的申请书上传覆盖之前的申请书
	 */
	public function reUploadApply(Request $request) {
		$id = session('proposer')->id;
		$apply_id = $request->id;
		$apply = Apply::find($apply_id);
		if($apply->proposer_id != $id) {
			exit('不能对其他申请进行覆盖！');
		}
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
		$apply->update([
			'title' => $title
		]);
		$upload_path = config('filesystems.disks.apply_uploads.root').'/'.$id.'/'.$apply->modify_time;
		if(!$file->move($upload_path,$apply_id)) {
			exit('保存文件失败！');
		}
		return redirect()->route('proposer_index', [$apply_id]);
	}

	/*
	 * 对于未通过审批的申请书重新上传
	 */
	public function no_passUpload(Request $request) {
		$id = session('proposer')->id;
		$apply_id = $request->id;
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
		$apply = Apply::find($apply_id);
		if($apply->proposer_id != $id) {
			exit('不能对其他申请进行重新上传！');
		}
		// 修改申请书状态和修改次数
		$apply->update([
			'title' => $title,
			'modify_time' => $apply->modify_time + 1,
			'state' => Apply::NO_ASSIGN_WAIT_REVIEW
		]);
		$upload_path = config('filesystems.disks.apply_uploads.root').'/'.$id.'/'.$apply->modify_time;
		if(!is_dir($upload_path)) {
			mkdir($upload_path, 0777,true);
		}
		if(!$file->move($upload_path,$apply_id)) {
			exit('保存文件失败！');
		}
		return redirect()->route('proposer_index', [$apply_id]);
	}

	/*
	 * 修改密码
	 */
	public function changePwd(Request $request) {
		$proposer = session('proposer');
		if($proposer->password != $request->pwd0) {
			return response()->json(new Res(Code::error,'原密码错误！'));
		}
		$proposer->password = $request->pwd1;
		$proposer->save();
		session()->flush();
		return response()->json(new Res(Code::success,''));
	}

	/*
	 * 下载已经上传的申请书
	 */
	public function download(Request $request, $apply_id) {
		$proposer = session('proposer');
		$apply = Apply::where('id',$apply_id)
						->where('proposer_id',$proposer->id)
						->first();
		// 如果下载的申请书不是申请人上传的
		if(!isset($apply)) {
			exit('无下载权限！');
		}
		return response()->download(storage_path('app/uploads/apply/'.$proposer->id.'/'.$apply->modify_time.'/'.$apply_id), $apply->title, ['application/msword']);
	}
}