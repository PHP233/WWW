<?php
/**
 * Created by PhpStorm.
 * User: ZJM
 * Date: 2017/9/24
 * Time: 21:10
 */

namespace App\Http\Controllers;


use App\Model\Apply;
use App\Model\Reviewer;
use App\Model\Suggest;
use Illuminate\Http\Request;

class ApplyController extends Controller {

	public function index(Request $request) {
		$checkers = Reviewer::where('role',0)->get();
		$applies = Apply::all();
		return view('reviewer.apply_admin',[
			'applies' => $applies,
			'checkers' => $checkers,
		]);
	}

	public function download(Request $request, $id=null) {
		$apply = Apply::find($id);
		return response()->download(storage_path('app\uploads\apply\\'.$apply->proposer_id.'\\'.$id), $apply->title, ['application/msword']);
	}

	public function get_review_list(Request $request) {
		return Suggest::with('reviewer')->where('apply_id',$request->apply_id)->get();
	}
}