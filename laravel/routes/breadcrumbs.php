<?php

// マイページ
Breadcrumbs::for('index', function ($trail) {
    $trail->push('マイページ', url('/books'));
});

// マイページ > [user]
Breadcrumbs::for('user.edit', function ($trail, $user) {
    $trail->parent('index');
    $trail->push($user->name, url('/user/' . $user->id));
});

// マイページ > [book]
Breadcrumbs::for('book.show', function ($trail, $book) {
    $trail->parent('index');
    $trail->push($book->title, url('/books/' . $book->id));
});

// マイページ > [book] > 書籍編集
Breadcrumbs::for('book.edit', function ($trail, $book) {
    $trail->parent('book.show', $book);
    $trail->push('書籍編集', url('/books/' . $book->id . '/edit'));
});

// マイページ > [book] > メモ編集
Breadcrumbs::for('memo.edit', function ($trail, $book, $memo) {
    $trail->parent('book.show', $book, $memo);
    $trail->push('メモ編集', url('/books/' . $book->id . '/memos/' . $memo->id . 'edit'));
});
