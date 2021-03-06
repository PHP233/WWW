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

	const ADMIN = 2;
	const REVIEWER = 1;
	const CHECKER = 0;

	protected $table = 'reviewer';

	protected $fillable = [
		'number','name', 'email', 'password','sex','role'
	];

	protected $hidden = ['password','updated_at'];

	public function role($role) {
		if ($role != null && $role == 0) {
			return '审议人';
		}
		return 'null';
	}

	public function sex() {
		if($this->sex == '1')
			return '男';
		return '女';
	}

	public function setPhoneAndEmail() {
		if($this->phone == null) {
			$this->phone = '';
		}
		if($this->email == null) {
			$this->email = '';
		}
	}

	public function reviewer_apply() {
		return $this->hasMany('App\Model\Apply','reviewer_id','id');
	}

	public function applies() {
		return $this->belongsToMany('App\Model\Apply', 'suggest','reviewer_id','apply_id')->withPivot('content','modify_time')->withTimestamps();
	}

	public function drafts() {
		return $this->belongsToMany('App\Model\Draft','suggest','reviewer_id','draft_id')->withPivot('content','modify_time')->withTimestamps();
	}

}