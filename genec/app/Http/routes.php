<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

// 不需要登录状态的操作
Route::any('reviewer/login', ['uses' => 'Committee@login', 'as' => 'reviewer_login']);
Route::any('reviewer/logout', ['uses' => 'Committee@logout', 'as' => 'reviewer_logout']);
Route::post('changePwd', ['uses' => 'Committee@changePwd', 'as' => 'changePwd']);
Route::post('updateInfo', ['uses' => 'Committee@updateInfo', 'as' => 'updateInfo']);
Route::any('resetPassword/{reviewer_id}/{newPassword}/{activeCode}', ['uses' => 'Committee@resetPassword', 'as' => 'resetPassword']);
Route::post('sendResetPasswordEmail', ['uses' => 'Committee@sendResetPasswordEmail', 'as' => 'sendResetPasswordEmail']);
Route::any('proposer/login', ['uses' => 'ProposerController@login','as' => 'proposer_login']);
Route::any('proposer/register', ['uses' => 'ProposerController@register','as' => 'proposer_register']);
Route::any('proposer/logout', ['uses' => 'ProposerController@logout','as' => 'proposer_logout']);
Route::get('emailVerification/{proposer_id}/{activeCode}', ['uses' => 'ProposerController@emailVerification', 'as' => 'emailVerification']);
Route::any('proposer/sendResetPassword',['uses'=>'ProposerController@sendEmailResetPassword', 'as' => 'proposer_sendResetPassword']);
Route::any('proposer/resetPassword/{proposer_id?}/{activeCode?}',['uses'=>'ProposerController@resetPassword', 'as' => 'proposer_resetPassword']);
Route::get('test/{r?}','Test@test');


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/
/*
 * 以下都进行登录验证和权限验证
 */
Route::group(['middleware' => ['web']], function () {
	Route::group(['prefix' => 'admin', 'as'=>'admin::'], function () {
		Route::any('/',['uses'=>'AdminController@index','as'=>'index']);
		#项目分配
		Route::any('assign',['uses' => 'AdminController@assign','as' => 'assign']);
		#人员管理
		Route::any('reviewer_admin', ['uses' => 'AdminController@reviewer_admin','as' => 'reviewer_admin']);
		Route::any('get_all_reviewers', ['uses' => 'AdminController@get_all_reviewers','as' => 'get_all_reviewers']);
		Route::any('delete_reviewer', ['uses' => 'AdminController@delete_reviewer','as' => 'delete_reviewer']);
		Route::any('add_reviewer', ['uses' => 'AdminController@add_reviewer','as' => 'add_reviewer']);
		Route::any('edit_reviewer', ['uses' => 'AdminController@edit_reviewer','as' => 'edit_reviewer']);
	});

	Route::group(['prefix' => 'reviewer'], function () {
		Route::any('draft_admin', ['uses' => 'ReviewController@draft_admin']);
		Route::any('assign', ['uses' => 'ReviewController@assign', 'as' => 'assign']);
		Route::any('passOrFail', ['uses' => 'ReviewController@passOrFail', 'as' => 'passOrFail']);
		Route::any('get_review_list', ['uses' => 'ReviewController@get_review_list', 'as' => 'get_review_list']);
		Route::get('publish', ['uses' => 'ReviewController@publish','as' => 'publish']);
		Route::get('dropProject', ['uses' => 'ReviewController@dropProject','as' => 'dropProject']);


		Route::group(['prefix' => 'apply', 'as' => 'apply::'], function () {
			Route::any('/', ['uses' => 'ApplyController@index', 'as' => 'index']);
			Route::any('download/{id}/{modify_time}', ['uses' => 'ApplyController@download', 'as' => 'download']);
		});

		Route::group(['prefix' => 'draft', 'as' => 'draft::'], function () {
			Route::any('/', ['uses' => 'DraftController@index', 'as' => 'index']);
			Route::post('upload', ['uses' => 'DraftController@upload', 'as' => 'upload']);
			Route::any('to_draft_upload', ['uses' => 'DraftController@to_draft_upload', 'as' => 'to_draft_upload']);
			Route::any('download/{id}/{modify_time}', ['uses' => 'DraftController@download', 'as' => 'download']);
		});

	});

	# 审议人模块
	Route::group(['prefix' => 'checker', 'as' => 'checker::'], function () {
		Route::any('/', ['uses' => 'CheckerController@index', 'as' => 'index']);
		Route::any('toDraft', ['uses' => 'CheckerController@toDraft', 'as' => 'toDraft']);
		Route::any('get_my_apply/{type?}', ['uses'=>'CheckerController@get_my_apply', 'as' => 'get_my_apply']);
		Route::post('suggest', ['uses' => 'CheckerController@suggest', 'as' => 'suggest']);
		Route::get('record', ['uses' => 'CheckerController@record', 'as' => 'record']);
		Route::any('download_apply/{id}/{modify_time}', ['uses' => 'ApplyController@download', 'as' => 'download_apply']);
		Route::any('download_draft/{id}/{modify_time}', ['uses' => 'DraftController@download', 'as' => 'download_draft']);
	});

	Route::group(['prefix' => 'proposer'], function () {
		Route::any('add_apply', ['uses' => 'ProposerController@add_apply','as' => 'proposer_add_apply']);
		Route::any('reUploadApply', ['uses' => 'ProposerController@reUploadApply','as' => 'reUploadApply']);
		Route::any('no_passUpload',['uses' => 'ProposerController@no_passUpload', 'as' => 'no_passUpload']);
		Route::post('changePwd',['uses' => 'ProposerController@changePwd','as'=>'proposer_changePwd']);
		Route::any('download/{apply_id}',['uses'=>'ProposerController@download', 'as' => 'proposer_download']);
		Route::any('{id?}', ['uses' => 'ProposerController@index','as' => 'proposer_index']);
	});

});
