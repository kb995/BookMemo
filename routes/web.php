<?php

Auth::routes();

Route::group(['middleware' => 'auth', 'prefix' => 'books', 'as' => 'books.'], function() {
    Route::get('/create', 'BookController@create')->name('create');

    // ===== Book =====
    // タグ検索
    Route::get('/search/{btag}', 'BookController@searchTag')->name('btag');
    // キーワード検索
    Route::post('/search', 'BookController@searchKeyword')->name('keyword');

    // 一覧
    Route::get('/', 'BookController@index')->name('index');

    // 詳細
    Route::get('/{book}', 'BookController@show')->name('show');

    // 登録
    Route::post('/create', 'BookController@store')->name('store');


    // 編集
    Route::get('/{book}/edit', 'BookController@edit')->name('edit');
    Route::patch('/{book}/edit', 'BookController@update')->name('update');
    // 削除
    Route::delete('/{book}/destroy', 'BookController@destroy')->name('destroy');

    // ===== Memo =====
    Route::group(['prefix' => '{book}/memos', 'as' => 'memos.'], function(){
        // キーワード検索
        Route::post('/search', 'MemoController@searchKeyword')->name('keyword');
        // タグ検索
        Route::get('/{mtag}', 'MemoController@searchTags')->name('mtag');

        // 登録
        Route::get('/create', 'MemoController@create')->name('create');
        Route::post('/create', 'MemoController@store')->name('store');
        // 編集
        Route::get('/{memo}/edit', 'MemoController@edit')->name('edit');
        Route::patch('/{memo}/edit', 'MemoController@update')->name('update');
        // 削除
        Route::delete('/{memo}/destroy', 'MemoController@destroy')->name('destroy');

    });
});

Route::get('/home', 'HomeController@index')->name('home');
