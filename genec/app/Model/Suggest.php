<?php
/**
 * Created by PhpStorm.
 * User: ZJM
 * Date: 2017/9/27
 * Time: 19:07
 */

namespace App\Model;


use Illuminate\Database\Eloquent\Model;

class Suggest extends Model {
	protected $table = 'suggest';

	protected $guarded = [ 'id' ];

	public function reviewer() {
		return $this->belongsTo('App\Model\Reviewer');
	}
}