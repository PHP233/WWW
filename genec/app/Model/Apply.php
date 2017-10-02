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
	const DROPPED = 5;

	protected $table = 'apply';

	public function proposer() {
		return $this->belongsTo('App\Model\Proposer','proposer_id');
	}

	public function state() {
		$arr = [
			self::NO_ASSIGN_WAIT_REVIEW => '未审议',
			self::ASSIGN_WAIT_REVIEW => '未审议已分配',
			self::WAIT_PASS => '已审议待审批',
			self::NO_PASS => '未通过审批',
			self::PASS => '已批准',
			self::DROPPED => '已撤销',
		];

		if($this->state !== null) {
			return array_key_exists($this->state, $arr) ? $arr[$this->state] : $arr[self::NO_ASSIGN_WAIT_REVIEW];
		}
		return $arr[self::NO_ASSIGN_WAIT_REVIEW];
	}

	public function adviceBtn() {
		$arr = [
			self::NO_ASSIGN_WAIT_REVIEW => [
				'url' => 'javascript:openAssignTaskModal('.$this->id.',\''.$this->title.'\');',
				'btnName' => '分配审议人审议',
			],
			self::ASSIGN_WAIT_REVIEW => [
				'url' => 'javascript:reviewList('.$this->id.','.$this->modify_time.',"'.$this->title.'");',
				'btnName' => '查看审议情况/审批',
			],
			self::WAIT_PASS => [
				'url' => 'javascript:reviewList('.$this->id.','.$this->modify_time.',"'.$this->title.'");',
				'btnName' => '查看审议情况/审批',
			],
			self::NO_PASS => [
				'url' => '#',
				'btnName' => '-',
			],
			self::PASS => [
				'url' => '#',
				'btnName' => '-',
			],
			self::DROPPED => [
				'url' => '#',
				'btnName' => '-',
			],
		];
		if($this->state !== null) {
			$btn = array_key_exists($this->state, $arr) ? $arr[$this->state] : $arr[self::NO_ASSIGN_WAIT_REVIEW];
		} else {
			$btn = $arr[self::NO_ASSIGN_WAIT_REVIEW];
		}
		return $btn;
	}

	public function getStateClass() {
		$arr = [
			self::NO_ASSIGN_WAIT_REVIEW => 'bg-warning',
			self::ASSIGN_WAIT_REVIEW => 'bg-warning',
			self::WAIT_PASS => 'bg-info',
			self::NO_PASS => 'bg-danger',
			self::PASS => 'bg-success',
			self::DROPPED => 'bg-danger',
		];
		if($this->state !== null) {
			return array_key_exists($this->state, $arr) ? $arr[$this->state] : $arr[self::NO_ASSIGN_WAIT_REVIEW];
		}
		return $arr[self::NO_ASSIGN_WAIT_REVIEW];
	}

	protected $guarded = ['id'];

	protected function getDateFormat() {
		return time();
	}

}