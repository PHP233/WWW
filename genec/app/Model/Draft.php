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

    public function apply() {
        return $this->belongsTo('App\Model\Apply','apply_id');
    }
}