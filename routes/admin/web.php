<?php

Route::resource('/posts', 'PostController');

// Pages
Route::get('/pages', 'PageController@index')->name('pages');
Route::get('/pages/new', 'PageController@new');
Route::post('/pages/save', 'PageController@save');
Route::get('/pages/edit/{id}', 'PageController@edit')->name('pages.edit');
