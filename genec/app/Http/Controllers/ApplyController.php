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

	public function download(Request $request) {
		$apply_id = $request->apply_id;
		$apply = Apply::find($apply_id);
		return response()->download(storage_path('app\uploads\apply\\'.$apply->proposer_id.'\\'.$apply_id), $apply->title.'.doc', ['application/msword']);
	}

}