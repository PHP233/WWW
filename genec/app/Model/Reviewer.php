<?php
/**
 * Created by PhpStorm.
 * User: ZJM
 * Date: 2017/9/18
 * Time: 19:57
 */

namespace App\Model;


use Illuminate\Database\Eloquent\Model;

class Reviewer extends Model {

	protected $table = 'reviewer';

	protected $fillable = [
		'number','name', 'email', 'password','sex'
	];

	public function role($role) {
		if ($role != null && $role == 0) {
			return '审议人';
		}
		return 'null';
	}

	public function sex($sex) {
		if($sex == '1')
			return '男';
		return '女';
	}
}