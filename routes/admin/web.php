<?php

// Posts
Route::get('/posts', 'PostController@index')->name('admin.posts');
Route::get('/posts/new', 'PostController@new');
Route::post('/posts/save', 'PostController@save');
Route::get('/posts/edit/{id}', 'PostController@edit')->name('posts.edit');
