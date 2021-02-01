<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\FolderRequest;
use App\Models\Book;
use App\Models\Folder;
use Illuminate\Support\Facades\Auth;

class FolderController extends Controller
{
    /**
     * フォルダー登録フォームを表示する
     *
     * @param App\Models\Book
     *
     */

    public function showCreateForm(Book $book)
    {
        return view('folders.create', compact('book'));
    }

    /**
     * フォルダーを保存する
     *
     * @param App\Models\Folder
     * @param App\Models\Book
     * @param Illuminate\Http\Request;
     */

    public function store(Folder $folder, Book $book, Request $request)
    {
        $folder->name = $request->name;
        $folder->user_id = Auth::id();
        $folder->book_id = $book->id;
        $folder->save();

        session()->flash('flash_message', 'フォルダーを作成しました');

        return redirect()->route('books.show', ['book' => $book]);
    }

    /**
     * フォルダーを削除する
     *
     * @param App\Models\Folder
     * @param App\Models\Book
     */

    public function destroy(Book $book, Folder $folder)
    {
        //現在のフォルダーをセッションから受け取る
        $current_folder = session()->get('current_folder');

        // 対象のフォルダーインスタンスを絞り込んで削除
        $folder = Folder::where('name', $current_folder)->where('user_id', Auth::id())->delete();

        // メモのフォルダーカラムを取得してクリアする
        $memos = $book->memos()->where('folder', $current_folder)->get();
        foreach($memos as $memo) {
            $memo->folder = '';
            $memo->save();
        }

        session()->flash('flash_message', 'フォルダーを削除しました');
        return redirect()->route('books.show', ['book' => $book]);

    }

}
