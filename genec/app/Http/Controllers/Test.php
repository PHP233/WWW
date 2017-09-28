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
		$applies = Reviewer::find(24)->applies()->get();
		foreach ($applies as $apply) {
			echo $apply->pivot->content.'<br/>';
		}
		dd($applies);
	}
}