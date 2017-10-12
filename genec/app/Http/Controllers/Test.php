<?php
/**
 * Created by PhpStorm.
 * User: ZJM
 * Date: 2017/9/27
 * Time: 20:34
 */

namespace App\Http\Controllers;


use App\Model\Apply;
use App\Model\Reviewer;
use App\Model\Suggest;
use App\utils\Res;
use Illuminate\Database\QueryException;

class Test extends Controller {

	public function test() {
		$a = Apply::find(1);
		return $a;
	}
}