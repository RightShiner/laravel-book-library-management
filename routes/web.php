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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/books/search', 'BookController@search');
Route::get('/book/{bookId}', 'BookController@view');
Route::get('/books/add/{bookId}', 'BookController@add');
Route::get('/books/remove/{bookId}', 'BookController@remove');
Route::post('/books/order', 'BookController@store');
