<?php
/**
 * Created by PhpStorm.
 * User: ZJM
 * Date: 2017/9/24
 * Time: 20:32
 */

namespace App\Model;


use App\Model\Apply;

class Draft extends  Apply{
	protected $table = 'draft';

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
				'url' => 'javascript:dropProject('.$this->id.');',
				'btnName' => '撤销项目',
			],
			self::PASS => [
				'url' => 'javascript:publish('.$this->id.');',
				'btnName' => '出版',
			],
			self::DROPPED => [
				'url' => '#',
				'btnName' => '-',
			],
			self::PUBLISH => [
				'url' => '#',
				'btnName' => '-'
			]
		];
		if($this->state !== null) {
			$btn = array_key_exists($this->state, $arr) ? $arr[$this->state] : $arr[self::NO_ASSIGN_WAIT_REVIEW];
		} else {
			$btn = $arr[self::NO_ASSIGN_WAIT_REVIEW];
		}
		return $btn;
	}

    public function apply() {
        return $this->belongsTo('App\Model\Apply','apply_id');
    }
}