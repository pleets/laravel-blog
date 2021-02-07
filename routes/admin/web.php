<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\PostController;
use Illuminate\Support\Facades\Route;

Route::resource('/categories', CategoryController::class);

Route::resource('/posts', PostController::class);

// Pages
Route::get('/pages', [PageController::class, 'index'])->name('pages');
Route::get('/pages/new', [PageController::class, 'new']);
Route::post('/pages/save', [PageController::class, 'save']);
Route::get('/pages/edit/{id}', [PageController::class, 'edit'])->name('pages.edit');
