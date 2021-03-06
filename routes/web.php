<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();
Route::get('/', 'HomeController@index');

Route::get('/logout', 'Auth\LoginController@logout');

Route::get('/post/{id}', ['as'=>'home.post', 'uses'=>'AdminPostsController@post']);

Route::group(['middleware'=>'admin'], function (){

    Route::get('/admin', ['as'=>'admin.index', 'uses'=>'AdminController@index']);
    Route::resource('/admin/users', 'AdminUsersController');
    Route::resource('/admin/posts', 'AdminPostsController');
    Route::resource('/admin/categories', 'AdminCategoriesController');
    Route::resource('/admin/media', 'AdminMediasController');
    Route::resource('/admin/comments', 'PostCommentController');
    Route::resource('/admin/comments/replies', 'CommentRepliesController');


});

Route::delete('admin/delete/media', 'AdminMediasController@deleteMedia');

Route::group(['middleware'=>'auth'], function(){
    Route::post('comment/reply', 'CommentRepliesController@createReply');
});
