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
	const WAIT_PASS = 1;
	const NO_PASS = 2;
	const PASS = 3;

	protected $table = 'apply';

	public function proposer() {
		return $this->belongsTo('App\Model\Proposer','proposer_id');
	}

	public function state($state = null) {
		$arr = [
			self::WAIT_REVIEW => '未审查',
			self::WAIT_PASS => '已审查待审批',
			self::NO_PASS => '已审批未通过',
			self::PASS => '已批准',
		];

		if($state !== null) {
			return array_key_exists($state, $arr) ? $arr[$state] : $arr[self::WAIT_REVIEW];
		}
		return $arr[self::WAIT_REVIEW];
	}

	protected function getDateFormat() {
		return time();
	}

	public function getStateClass($state) {
		$arr = [
			self::WAIT_REVIEW => 'bg-warning',
			self::WAIT_PASS => 'bg-info',
			self::NO_PASS => 'bg-danger',
			self::PASS => 'bg-success',
		];
		if($state !== null) {
			return array_key_exists($state, $arr) ? $arr[$state] : $arr[self::WAIT_REVIEW];
		}
		return $arr[self::WAIT_REVIEW];
	}
}