<?php
/**
 * Created by PhpStorm.
 * User: ZJM
 * Date: 2017/9/23
 * Time: 18:32
 */

namespace App\utils;


class Code {

	const success = 1;
	const error = 0;
	const apply_pre = 'PSA';
	const draft_pre = 'PSD';

    public static function getApplyNumber($apply) {
        if($apply != null) {
            $date = date('Ymd',$apply->created_at);
            return $number = $date.$apply->id;
        }
        return '';
    }

    public static function getDraftNumber($apply) {
        if($apply != null) {
            $date = date('Ymd',strtotime($apply->created_at));
            return $number = $date.$apply->id;
        }
        return '';
    }

    public static function turnStateToStep($apply) {
    	switch ($apply->state) {
		    case 0:
		    	return 1;
		    case 1:
		    case 2:
		    case 3:
			    return 2;
		    case 4:
		    	return 3;
		    case 5:
		    	return 2;
		    default:
		    	break;
	    }
    }
}