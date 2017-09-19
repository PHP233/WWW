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
    Route::any('proposer/login', ['uses' => 'ProposerController@login','as' => 'proposer_login']);
    Route::any('proposer/register', ['uses' => 'ProposerController@register','as' => 'proposer_register']);
    Route::any('proposer', ['uses' => 'ProposerController@index','as' => 'proposer_index']);
    Route::any('proposer/logout', ['uses' => 'ProposerController@logout','as' => 'proposer_logout']);
});
