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
    Route::any('reviewer/login', ['uses' => 'ReviewController@login']);
    Route::any('reviewer/admin', ['uses' => 'ReviewController@admin']);
    Route::any('reviewer/download/{filename}', ['uses' => 'ReviewController@download','as' => 'reviewer_download']);
    Route::any('proposer/login', ['uses' => 'ProposerController@login','as' => 'proposer_login']);
    Route::any('proposer/register', ['uses' => 'ProposerController@register','as' => 'proposer_register']);
	Route::any('proposer/add_apply', ['uses' => 'ProposerController@add_apply','as' => 'proposer_add_apply']);
    Route::any('proposer/logout', ['uses' => 'ProposerController@logout','as' => 'proposer_logout']);
	Route::any('proposer/{id?}', ['uses' => 'ProposerController@index','as' => 'proposer_index']);
});
