<?php
/**
 * Created by PhpStorm.
 * User: ZJM
 * Date: 2017/9/22
 * Time: 0:24
 */

namespace App\utils;

/*
 * 用于 datatables 的 json 数据包裹: data{}
 */
class Data {

	var $data;

	public function setData($arr) {
		$this->data = $arr;
	}

	public function Data($data) {
		$this->data = $data;
	}
}