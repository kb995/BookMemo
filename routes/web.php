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

Route::group(['middleware' => 'auth', 'prefix' => 'books', 'as' => 'books.'], function() {

    // 一覧
    Route::get('/', 'BookController@index')->name('index');
    Route::get('/{book}', 'BookController@show')->name('show');
    // 登録
    // Route::get('create', 'BookController@create')->name('create');
    Route::post('/', 'BookController@store')->name('store');
    // 編集
    Route::get('/{book}/edit', 'BookController@edit')->name('edit');
    Route::patch('/{book}/edit', 'BookController@update')->name('update');
    // 削除
    Route::delete('/{book}/destroy', 'BookController@destroy')->name('destroy');

    // Route::resource('/', 'BookController');
    // Route::resource('/memos', 'MemoController');

});
// Route::prefix('books')->name('books.')->group(function () {

// });


Route::get('/home', 'HomeController@index')->name('home');
