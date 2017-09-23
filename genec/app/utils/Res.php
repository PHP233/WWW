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
}