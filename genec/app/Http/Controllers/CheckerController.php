<?php
/**
 * Created by PhpStorm.
 * User: ZJM
 * Date: 2017/9/28
 * Time: 15:35
 */

namespace App\Http\Controllers;


use App\Model\Apply;
use App\Model\Reviewer;
use App\utils\Data;

class CheckerController extends Controller {

	public function index() {
		return view('checker.apply_checker');
	}

	public function get_my_apply() {
		$reviewer_id = session()->get('reviewer')->id;
		$applies = Reviewer::find($reviewer_id)->applies()->where('state','<',2)->get();
		$data = new Data();
		$data->setData($applies);
		return response()->json($data);
	}
}