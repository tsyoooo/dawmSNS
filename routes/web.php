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

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/home', 'HomeController@index')->name('home');

//Auth::routes();


//ログアウト中のページ
Route::get('/login', 'Auth\LoginController@login');
Route::post('/login', 'Auth\LoginController@login');

Route::get('/register', 'Auth\RegisterController@register');
Route::post('/register', 'Auth\RegisterController@register');

Route::get('/added', 'Auth\RegisterController@added');


//-----ログイン中のページ-----
//要綱
Route::post('/top','PostsController@create');

Route::get('/top','PostsController@index');
//ログアウト
Route::get('/logout','Auth\LoginController@logout');

//更新
Route::post('/update', 'PostsController@update');
//投稿削除
Route::get('post/{id}/top','PostsController@delete');

//プロフィール編集
Route::get('/profileEdit','UsersController@profileEdit');
Route::post('/profileEdit','UsersController@register');

//検索ページ表示
Route::get('/search','UsersController@search');
//検索結果表示
Route::post('/searchResult','UsersController@searchResult');
Route::get('/searchResult','UsersController@searchResult');

//フォローする
Route::get('follow/{id}/search','UsersController@follow');
Route::get('follow/{id}/searchResult','UsersController@follow');
Route::get('unfollow/{id}/profile','UsersController@follow');
Route::get('/{id}/profile','UsersController@follow');
//フォロー外す
Route::get('unfollow/{id}/search','UsersController@unfollow');
Route::get('unfollow/{id}/searchResult','UsersController@unfollow');
Route::get('unfollow/{id}/profile','UsersController@unfollow');
Route::get('/{id}/profile','UsersController@unfollow');

//フォローリスト表示
Route::get('/followlist','FollowsController@followList');
//フォロワーリスト表示
Route::get('/followerlist','FollowsController@followerList');

//プロフィール画面へ移行
Route::get('/{id}/profile','UsersController@profile');
Route::post('/{id}/profile','UsersController@profile');
