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

	const NO_ASSIGN_WAIT_REVIEW = 0;
	const ASSIGN_WAIT_REVIEW = 1;
	const WAIT_PASS = 2;
	const NO_PASS = 3;
	const PASS = 4;

	protected $table = 'apply';

	public function proposer() {
		return $this->belongsTo('App\Model\Proposer','proposer_id');
	}

	public function state($state = null) {
		$arr = [
			self::NO_ASSIGN_WAIT_REVIEW => '未审议',
			self::ASSIGN_WAIT_REVIEW => '未审议已分配审议任务',
			self::WAIT_PASS => '已审议待审批',
			self::NO_PASS => '已审批未通过',
			self::PASS => '已批准',
		];

		if($state !== null) {
			return array_key_exists($state, $arr) ? $arr[$state] : $arr[self::WAIT_REVIEW];
		}
		return $arr[self::WAIT_REVIEW];
	}

	public function adviceBtn($state) {
		$arr = [
			self::NO_ASSIGN_WAIT_REVIEW => [
				'url' => 'javascript:openAssignTaskModal();',
				'btnName' => '分配审议人审议',
			],
			self::ASSIGN_WAIT_REVIEW => [
				'url' => '#',
				'btnName' => '等待审议人审议',
			],
			self::WAIT_PASS => [
				'url' => '',
				'btnName' => '审批',
			],
			self::NO_PASS => [
				'url' => '',
				'btnName' => '分配审议人审议',
			],
			self::PASS => [
				'url' => '#',
				'btnName' => '-',
			],
		];
		if($state !== null) {
			$btn = array_key_exists($state, $arr) ? $arr[$state] : $arr[self::NO_ASSIGN_WAIT_REVIEW];
		} else {
			$btn = $arr[self::NO_ASSIGN_WAIT_REVIEW];
		}
		return $btn;
	}

	protected function getDateFormat() {
		return time();
	}

	public function getStateClass($state) {
		$arr = [
			self::NO_ASSIGN_WAIT_REVIEW => 'bg-warning',
			self::ASSIGN_WAIT_REVIEW => 'bg-warning',
			self::WAIT_PASS => 'bg-info',
			self::NO_PASS => 'bg-danger',
			self::PASS => 'bg-success',
		];
		if($state !== null) {
			return array_key_exists($state, $arr) ? $arr[$state] : $arr[self::NO_ASSIGN_WAIT_REVIEW];
		}
		return $arr[self::NO_ASSIGN_WAIT_REVIEW];
	}
}