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
		Route::any('login', ['uses' => 'ReviewController@login']);
		Route::any('logout', ['uses' => 'ReviewController@logout', 'as' => 'reviewer_logout']);
		Route::any('draft_admin', ['uses' => 'ReviewController@draft_admin']);
		Route::any('reviewer_admin', ['uses' => 'ReviewController@reviewer_admin','as' => 'reviewer_admin']);
		Route::any('get_all_reviewers', ['uses' => 'ReviewController@get_all_reviewers','as' => 'get_all_reviewers']);
		Route::any('delete_reviewer', ['uses' => 'ReviewController@delete_reviewer','as' => 'delete_reviewer']);
		Route::any('add_reviewer', ['uses' => 'ReviewController@add_reviewer','as' => 'add_reviewer']);
		Route::any('edit_reviewer', ['uses' => 'ReviewController@edit_reviewer','as' => 'edit_reviewer']);
		Route::any('assign', ['uses' => 'ReviewController@assign', 'as' => 'assign']);
		Route::group(['prefix' => 'apply', 'as' => 'apply::'], function () {
			Route::any('/', ['uses' => 'ApplyController@index', 'as' => 'index']);
			Route::any('checker', ['uses' => 'ApplyController@checker', 'as' => '']);
			Route::any('download/{id?}', ['uses' => 'ApplyController@download', 'as' => 'download']);
			Route::any('get_review_list', ['uses' => 'ApplyController@get_review_list', 'as' => 'get_review_list']);
		});
		Route::group(['prefix' => 'draft', 'as' => 'draft::'], function () {
			Route::any('/', ['uses' => 'DraftController@index', 'as' => 'index']);
			Route::any('upload', ['uses' => 'DraftController@upload', 'as' => 'upload']);
		});
		Route::group(['prefix' => 'checker', 'as' => 'checker::'], function () {
			Route::any('/', ['uses' => 'CheckerController@index', 'as' => 'checker']);
			Route::any('get_my_apply', ['uses'=>'CheckerController@get_my_apply', 'as' => 'get_my_apply']);
			Route::post('suggest', ['uses' => 'CheckerController@suggest', 'as' => 'suggest']);
		});
	});
	Route::group(['prefix' => 'proposer'], function () {
		Route::any('login', ['uses' => 'ProposerController@login','as' => 'proposer_login']);
		Route::any('register', ['uses' => 'ProposerController@register','as' => 'proposer_register']);
		Route::any('add_apply', ['uses' => 'ProposerController@add_apply','as' => 'proposer_add_apply']);
		Route::any('logout', ['uses' => 'ProposerController@logout','as' => 'proposer_logout']);
		Route::any('{id?}', ['uses' => 'ProposerController@index','as' => 'proposer_index']);
	});

});

Route::get('test','Test@test');
