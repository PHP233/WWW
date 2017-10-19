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
use Mail;

class Test extends Controller {

	public function test() {
		Mail::raw('邮件内容', function ($message) {
			$message->from(env('MAIL_USERNAME'),'中国基因行业标准网');
			$message->subject('注册验证');
			$message->to('1549118476@qq.com');
		});
	}
}