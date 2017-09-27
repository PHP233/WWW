<?php
/**
 * Created by PhpStorm.
 * User: ZJM
 * Date: 2017/9/27
 * Time: 20:34
 */

namespace App\Http\Controllers;


use App\Model\Reviewer;
use App\Model\Suggest;
use Illuminate\Database\QueryException;

class Test extends Controller {

	public function test() {
		Suggest::create([
			'reviewer_id' => '1000'
		]);
	}
}