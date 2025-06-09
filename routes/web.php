<?php

use App\Http\Controllers\postController;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/post',[postController::class,'post'])->name('insert');

Route::post('/post',[postController::class,'insert_post'])->name('add_post');
Route::get('/edit_post/{id}',[postController::class,'update_post']);
Route::put('/update_form_data/{id}',[postController::class,'update_post_data'])->name('update_post_data');
Route::get('/delete_post/{id}',[postController::class,'delete_post']);
