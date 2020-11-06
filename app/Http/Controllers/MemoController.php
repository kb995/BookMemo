<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\MemoRequest;
use App\Models\Book;
use App\Models\Memo;
use App\User;


class MemoController extends Controller
{

    public function store(Book $book, Memo $memo, MemoRequest $request)
    {
        $memo->memo = $request->memo;
        $memo->book_id = $book->id;
        $memo->save();

        return redirect()->route('books.show', ['book' => $book]);
    }

    public function edit(Book $book, Memo $memo)
    {
        return view('memos.edit', compact('book', 'memo'));
    }

    public function update(MemoRequest $request, Book $book, Memo $memo)
    {
        $memo->memo = $request->memo;
        $memo->save();

        return redirect()->route('books.show', ['book' => $book]);
    }


    public function destroy(Book $book, Memo $memo)
    {
        $memo->delete();
        return redirect()->route('books.show', ['book' => $book]);
    }
}
