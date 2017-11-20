<?php
/**
 * Created by PhpStorm.
 * User: ZJM
 * Date: 2017/10/19
 * Time: 20:29
 */

namespace App\utils;
use Mail;

class SendEmail {

	public static function register($call, $url, $to) {
		Mail::send('proposer.regist_email',['call' => $call, 'url' => $url], function($message) use($to){
			$message->from(env('MAIL_USERNAME'),Code::FromName);
			$message->subject(Code::regist_subject);
			$message->to($to);
		});
	}

	/*
	 * 组委会成员重置密码
	 */
	public static function resetPassword($newPassword, $url, $to) {
		Mail::send('reviewer.reset_password',['newPassword' => $newPassword, 'url' => $url], function($message) use($to){
			$message->from(env('MAIL_USERNAME'),Code::FromName);
			$message->subject(Code::reset_password_subject);
			$message->to($to);
		});
	}
	/*
	 * 申请人找回密码
	 */
	public static function findPassword($activeCode, $url, $to) {

	}
}