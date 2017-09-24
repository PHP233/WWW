<?php
/**
 * Created by PhpStorm.
 * User: ZJM
 * Date: 2017/9/23
 * Time: 18:25
 */

namespace App\utils;


use Illuminate\Database\Eloquent\Model;

class Res {

	var $code;

	var $msg;

	var $reply;

	function __construct($code, $msg) {
		$this->code = $code;
		$this->msg = $msg;
	}

	public function setCode($code) {
		$this->code = $code;
	}
	public function setMsg($msg) {
		$this->msg = $msg;
	}
	public function setReply($reply) {
		$this->reply = $reply;
	}
}