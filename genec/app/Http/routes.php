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

Route::any('reviewer/login', ['uses' => 'ReviewController@login', 'as' => 'reviewer_login']);
Route::any('reviewer/logout', ['uses' => 'ReviewController@logout', 'as' => 'reviewer_logout']);
Route::any('proposer/login', ['uses' => 'ProposerController@login','as' => 'proposer_login']);
Route::any('proposer/register', ['uses' => 'ProposerController@register','as' => 'proposer_register']);
Route::any('proposer/logout', ['uses' => 'ProposerController@logout','as' => 'proposer_logout']);
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

Route::group(['middleware' => ['web']], function () {
	Route::group(['prefix' => 'reviewer'], function () {
		Route::any('draft_admin', ['uses' => 'ReviewController@draft_admin']);
		Route::any('reviewer_admin', ['uses' => 'ReviewController@reviewer_admin','as' => 'reviewer_admin']);
		Route::any('get_all_reviewers', ['uses' => 'ReviewController@get_all_reviewers','as' => 'get_all_reviewers']);
		Route::any('delete_reviewer', ['uses' => 'ReviewController@delete_reviewer','as' => 'delete_reviewer']);
		Route::any('add_reviewer', ['uses' => 'ReviewController@add_reviewer','as' => 'add_reviewer']);
		Route::any('edit_reviewer', ['uses' => 'ReviewController@edit_reviewer','as' => 'edit_reviewer']);
		Route::any('assign', ['uses' => 'ReviewController@assign', 'as' => 'assign']);
		Route::any('passOrFail', ['uses' => 'ReviewController@passOrFail', 'as' => 'passOrFail']);
		Route::any('get_review_list', ['uses' => 'ReviewController@get_review_list', 'as' => 'get_review_list']);
		Route::get('publish', ['uses' => 'ReviewController@publish','as' => 'publish']);
		Route::get('dropProject', ['uses' => 'ReviewController@dropProject','as' => 'dropProject']);

		Route::group(['prefix' => 'apply', 'as' => 'apply::'], function () {
			Route::any('/', ['uses' => 'ApplyController@index', 'as' => 'index']);
			Route::any('checker', ['uses' => 'ApplyController@checker', 'as' => '']);
			Route::any('download/{id?}', ['uses' => 'ApplyController@download', 'as' => 'download']);
		});

		Route::group(['prefix' => 'draft', 'as' => 'draft::'], function () {
			Route::any('/', ['uses' => 'DraftController@index', 'as' => 'index']);
			Route::any('upload', ['uses' => 'DraftController@upload', 'as' => 'upload']);
			Route::any('download/{id?}', ['uses' => 'DraftController@download', 'as' => 'download']);
			Route::any('isHasDraft', ['uses' => 'DraftController@isHasDraft', 'as' => 'isHasDraft']);
		});

		Route::group(['prefix' => 'checker', 'as' => 'checker::'], function () {
			Route::any('/', ['uses' => 'CheckerController@index', 'as' => 'checker']);
			Route::any('toDraft', ['uses' => 'CheckerController@toDraft', 'as' => 'toDraft']);
			Route::any('get_my_apply/{type?}', ['uses'=>'CheckerController@get_my_apply', 'as' => 'get_my_apply']);
			Route::post('suggest', ['uses' => 'CheckerController@suggest', 'as' => 'suggest']);
			Route::get('record', ['uses' => 'CheckerController@record', 'as' => 'record']);
		});
	});

	Route::group(['prefix' => 'proposer'], function () {
		Route::any('add_apply', ['uses' => 'ProposerController@add_apply','as' => 'proposer_add_apply']);
		Route::any('reUploadApply', ['uses' => 'ProposerController@reUploadApply','as' => 'reUploadApply']);
		Route::any('no_passUpload',['uses' => 'ProposerController@no_passUpload', 'as' => 'no_passUpload']);
		Route::any('{id?}', ['uses' => 'ProposerController@index','as' => 'proposer_index']);
	});

});
