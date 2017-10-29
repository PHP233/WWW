<?php
/**
 * Created by PhpStorm.
 * User: ZJM
 * Date: 2017/10/29
 * Time: 17:22
 */

namespace App\Http\Controllers;


use App\Model\Reviewer;
use App\utils\Data;

class AdminController extends Controller  {

	public function reviewer_admin() {
		return view('admin.reviewer_admin');
	}

	public function get_all_reviewers() {
		$reviews = Reviewer::where('role',Reviewer::CHECKER)
		                   ->orWhere('role',Reviewer::REVIEWER)
		                   ->get();
		$data = new Data();
		$data->setData($reviews);
		return response()->json($data);
	}

	public function index() {
		return view('admin.reviewer_admin');
	}
}