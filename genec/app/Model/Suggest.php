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

	protected function getDateFormat() {
		return time();
	}
}