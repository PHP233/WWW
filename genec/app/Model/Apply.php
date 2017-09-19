<?php
/**
 * Created by PhpStorm.
 * User: ZJM
 * Date: 2017/9/19
 * Time: 12:55
 */

namespace App\Model;


use Illuminate\Database\Eloquent\Model;

class Apply extends Model {

	const WAIT_REVIEW = 0;
	const NO_PASS = 1;
	const PASS = 2;

	protected $table = 'apply';

	public function proposer() {
		return $this->belongsTo('App\Model\Proposer');
	}

	public function state($state = null) {
		$arr = [
			self::WAIT_REVIEW => '待审查',
			self::NO_PASS => '已审查未通过',
			self::PASS => '已通过',
		];

		if($state !== null) {
			return array_key_exists($state, $arr) ? $arr[$state] : $arr[self::WAIT_REVIEW];
		}
		return $arr[self::WAIT_REVIEW];
	}
}