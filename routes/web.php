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

/*Route::get('/', function () {
    return view('welcome');
});*/

Auth::routes(['register' => false]);

//Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'BlogController@index')->name('home');
Route::get('/category/{id}', 'BlogController@category')->name('category');

Route::get('/article/new', 'ArticleController@new');
Route::post('/article/save', 'ArticleController@save');
Route::get('/article/{title}', 'ArticleController@read')->name('post');
Route::get('/article/edit/{id}', 'ArticleController@edit')->name('article.edit');

Route::get('/posts', 'PostController@index')->name('posts');