<?php

// Posts
Route::get('/posts', 'PostController@index')->name('admin.posts');
Route::get('/posts/new', 'PostController@new');
Route::post('/posts/save', 'PostController@save');
Route::get('/posts/edit/{id}', 'PostController@edit')->name('posts.edit');

// PAges
Route::get('/pages', 'PageController@index')->name('admin.pages');
Route::get('/pages/new', 'PageController@new');
Route::post('/pages/save', 'PageController@save');
Route::get('/pages/edit/{id}', 'PageController@edit')->name('pages.edit');
