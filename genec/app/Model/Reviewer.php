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
		'number', 'email', 'password',
	];

	public function role($role) {
		if ($role != null && $role == 0) {
			return '审议人';
		}
		return 'null';
	}
}