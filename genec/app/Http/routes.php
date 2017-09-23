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
		Route::any('apply_admin', ['uses' => 'ReviewController@apply_admin']);
		Route::any('draft_admin', ['uses' => 'ReviewController@draft_admin']);
		Route::any('reviewer_admin', ['uses' => 'ReviewController@reviewer_admin','as' => 'reviewer_admin']);
		Route::any('get_all_reviewers', ['uses' => 'ReviewController@get_all_reviewers','as' => 'get_all_reviewers']);
		Route::any('download/{filename}', ['uses' => 'ReviewController@download','as' => 'reviewer_download']);
		Route::any('delete_reviewer', ['uses' => 'ReviewController@delete_reviewer','as' => 'delete_reviewer']);
		Route::any('add_reviewer', ['uses' => 'ReviewController@add_reviewer','as' => 'add_reviewer']);
	});
	Route::group(['prefix' => 'proposer'], function () {
		Route::any('login', ['uses' => 'ProposerController@login','as' => 'proposer_login']);
		Route::any('register', ['uses' => 'ProposerController@register','as' => 'proposer_register']);
		Route::any('add_apply', ['uses' => 'ProposerController@add_apply','as' => 'proposer_add_apply']);
		Route::any('logout', ['uses' => 'ProposerController@logout','as' => 'proposer_logout']);
		Route::any('{id?}', ['uses' => 'ProposerController@index','as' => 'proposer_index']);
	});
});
