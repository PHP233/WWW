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
	const apply_pre = 'PSA';
	const draft_pre = 'PSD';

	/*
	 * 申请书的文件编号
	 */
    public static function getApplyNumber($apply) {
        if($apply != null) {
            $date = date('Ymd',$apply->created_at);
            return $number = $date.$apply->id;
        }
        return '';
    }

    /*
     * 送审表的文件编号
     */
    public static function getDraftNumber($apply) {
        if($apply != null) {
            $date = date('Ymd',$apply->created_at);
            return $number = $date.$apply->id;
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
}