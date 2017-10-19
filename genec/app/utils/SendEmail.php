<?php
/**
 * Created by PhpStorm.
 * User: ZJM
 * Date: 2017/10/19
 * Time: 20:29
 */

namespace App\utils;
use function foo\func;
use Mail;

class SendEmail {

	public static function register($call, $url, $to) {
		Mail::send('common.proposer.regist_email',['call' => $call, 'url' => $url], function($message) use($to){
			$message->from(env('MAIL_USERNAME'),Code::FromName);
			$message->subject(Code::regist_subject);
			$message->to($to);
		});
	}

}