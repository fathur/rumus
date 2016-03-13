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

    Route::get('/', ['uses' => 'PostController@index', 'as' => 'home']);

    Route::resource('post', 'PostController');
    Route::post('post/preview', ['uses' => 'PostController@preview', 'as' => 'post.preview']);

    Route::resource('post.example', 'ExampleController');
    Route::post('example/preview', ['uses' => 'ExampleController@preview', 'as' => 'example.preview']);
    Route::post('example/preview/ajax', ['uses' => 'ExampleController@postPreviewAjax', 'as' => 'example.preview.ajax']);
    Route::get('example/answer', ['uses' => 'ExampleController@getAnswer', 'as' => 'example.answer']);
    Route::put('example/answer', ['uses' => 'ExampleController@putAnswer', 'as' => 'example.answer.update']);

    Route::get('{slug}', ['uses' => 'PostController@show', 'as' => 'post.slug']);
});
