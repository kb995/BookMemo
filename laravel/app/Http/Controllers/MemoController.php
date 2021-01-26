<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\MemoRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Book;
use App\Models\Memo;
use App\User;

class MemoController extends Controller
{
    /**
     * メモを保存する
     *
     * @param App\Models\Book
     * @param App\Models\Memo
     * @param App\Http\Requests\MemoRequest;
     *
     * todo: リクエストをfillに
     */
    public function store(Book $book, Memo $memo, MemoRequest $request)
    {
        // リクエスト
        $memo->memo = $request->memo;
        // $memo->tag = $request->tag;
        $memo->book_id = $book->id;
        $memo->save();

        session()->flash('flash_message', 'メモを追加しました');

        return redirect()->route('books.show', ['book' => $book]);
    }

    /**
     * メモ編集画面を表示する
     *
     * @param App\Models\Book
     * @param App\Models\Memo
     */
    public function edit(Book $book, Memo $memo)
    {
        // 認可
        $this->authorize('update', $book);

        return view('memos.edit', compact('book', 'memo'));
    }

    /**
     * メモを修正する
     *
     * @param App\Http\Requests\MemoRequest
     * @param App\Models\Book
     * @param App\Models\Memo
     */
    public function update(MemoRequest $request, Book $book, Memo $memo)
    {
        // 認可
        $this->authorize('update', $book);

        // リクエスト
        $memo->memo = $request->memo;
        $memo->save();

        session()->flash('flash_message', 'メモを編集しました');

        return redirect()->route('books.show', ['book' => $book]);
    }

    /**
     * メモを削除する
     *
     * @param App\Models\Book
     * @param App\Models\Memo
     */
    public function destroy(Book $book, Memo $memo)
    {
        // 認可
        $this->authorize('delete', $book);

        $memo->delete();

        session()->flash('flash_message', 'メモを削除しました');

        return redirect()->route('books.show', ['book' => $book]);
    }

}
