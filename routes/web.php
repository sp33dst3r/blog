<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
   // return view('welcome');
   return redirect('categories');
});

Route::get('/categories', "CategoryController@index")->name('categories');
Route::match(array('GET', 'POST'), 'categories/create', "CategoryController@create");
Route::match(array('GET', 'POST'), 'categories/edit/{id}', "CategoryController@edit");
Route::match(array('GET'), 'categories/view/{id}', "CategoryController@view");
Route::match(array('GET'), 'categories/delete/{id}', "CategoryController@delete");


Route::match(array('GET', 'POST'), 'categories/{category_id}/posts/create/', "PostController@create");
Route::match(array('GET', 'POST'), 'categories/{category_id}/posts/edit/{id}', "PostController@edit");
Route::match(array('GET', 'POST'), 'categories/{category_id}/posts/view/{id}', "PostController@view");
Route::match(array('GET'), 'categories/{category_id}/posts/{id}/delete', "PostController@delete");


Route::match(array('POST'), '/addComment', "CommentController@create");
