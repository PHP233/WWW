<?php
/**
 * Created by PhpStorm.
 * User: ZJM
 * Date: 2017/9/23
 * Time: 18:32
 */

namespace App\utils;


use App\Model\Apply;

class Code {

	const success = 1;
	const error = 0;
	const reviewer = 1;
	const checker = 0;
	const admin = 2;
	const apply_pre = 'PSA';
	const draft_pre = 'PSD';
	const FromName = '中国基因行业标准网';
	const regist_subject = '注册认证';

	/*
	 * 申请书的文件编号
	 */
    public static function getApplyNumber($apply) {
        if($apply != null) {
            return $apply->id.'号';
        }
        return '';
    }

    /*
     * 送审表的文件编号
     */
    public static function getDraftNumber($apply) {
        if($apply != null) {
            return $apply->id.'号';
        }
        return '';
    }

    /*
     * proposer index 项目申报流程导航图第几步
     */
    public static function turnStateToStep($apply) {
    	switch ($apply->state) {
		    case Apply::NO_ASSIGN_WAIT_REVIEW:
		    	return 1;
		    case Apply::ASSIGN_WAIT_REVIEW:
		    case Apply::WAIT_PASS:
		    case Apply::NO_PASS:
			    return 2;
		    case Apply::PASS:
		    	return 3;
		    case Apply::DROPPED:
		    	return 0;
		    default:
		    case Apply::DRAFT_UPLOAD:
		    	return 4;
		    case Apply::DRAFT_PASS:
		    	return 5;
		    case Apply::PUBLISH:
		    	return 6;
		    	break;
	    }
    }

    /*
     * 去掉申请书题目文件后缀名
     */
    public static function removeExt($title) {
    	$res = str_replace('.docx','',$title);
    	$res = str_replace('.doc','',$res);
    	return $res;
    }

    /*
     *  注册人称呼
     */
    public static function call($register) {
    	if($register->sex)
    		return $register->name.'先生';
    	return $register->name.'女士';
    }

    /*
     * 后台检验用户注册信息
     */
    public static function checkRegistInfo($register) {
    	if($register['name'] == null || trim($register['name']) == '') {
    		return [false,'姓名不能为空'];
	    }
	    if($register['email'] == null || trim($register['email']) == '') {
    		return [false,'邮箱不能为空'];
	    }
	    if($register['phone'] == null || trim($register['phone']) == '') {
    		return [false,'电话不能为空'];
	    }
	    if(strlen($register['phone']) != 11) {
    		return [false,'手机号码长度应为11位'];
	    }
	    $pattern = "/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i";
	    if (!preg_match( $pattern, $register['email'])) {
	    	return [false,'您输入的电子邮件地址不合法'];
	    }
	    return [true];
    }
}