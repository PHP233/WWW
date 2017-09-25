<?php
/**
 * Created by PhpStorm.
 * User: ZJM
 * Date: 2017/9/24
 * Time: 21:10
 */

namespace App\Http\Controllers;


use App\Model\Apply;
use Illuminate\Http\Request;

class ApplyController extends Controller {

	public function index(Request $request) {
		$applies = Apply::all();
		return view('reviewer.apply_admin')->with('applies', $applies);
	}

	public function download(Request $request, $id=null) {
		$apply = Apply::find($id);
		return response()->download(storage_path('app\uploads\apply\\'.$apply->proposer_id.'\\'.$id), $apply->title, ['application/msword']);
	}

}