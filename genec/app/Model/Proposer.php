<?php
/**
 * Created by PhpStorm.
 * User: ZJM
 * Date: 2017/9/19
 * Time: 9:46
 */

namespace App\Model;



use Illuminate\Database\Eloquent\Model;

class Proposer extends Model {

	protected $table = 'proposer';

	protected $fillable = [
		'name','email','phone','password','sex',
	];

	protected function getDateFormat()
	{
		return time();
	}

	public function applies() {
		return $this->hasMany('App\Model\Apply','proposer_id','id');
	}

	public function sex($sex) {
		if($sex == '1')
			return '男';
		return '女';
	}
}