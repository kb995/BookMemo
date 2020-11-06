<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\BookRequest;
use App\Models\Book;
use App\Models\Memo;
use App\User;



class BookController extends Controller
{
    public function index()
    {
        $user = User::find(Auth::id());
        $books = $user->books()->orderBy('created_at', 'desc')->get();

        return view('books.index', compact('books', 'user'));
    }

    public function create()
    {
        return view('books.create');
    }

    public function store(Book $book, BookRequest $request)
    {
        $book->title = $request->title;
        $book->author = $request->author;
        $book->isbn = $request->isbn;
        $book->description = $request->description;
        $book->status = $request->status;
        $book->read_at = $request->read_at;
        $book->user_id = Auth::id();
        $book->save();
        session()->flash('flash_message', '書籍を登録しました');

        return redirect()->route('books.index');
    }

    public function show(Book $book)
    {
        // $memos = Memo::all()->sortByDesc('id');
        // $memos = $book->memos()->get();

        $book = Book::find($book->id);
        $memos = $book->memos()->paginate(10);

        return view('books.show', compact('book', 'memos'));
    }

    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    public function update(Book $book, BookRequest $request)
    {
        $book->title = $request->title;
        $book->author = $request->author;
        $book->isbn = $request->isbn;
        $book->description = $request->description;
        $book->status = $request->status;
        $book->read_at = $request->read_at;
        $book->save();
        session()->flash('flash_message', '書籍を編集しました');

        return redirect()->route('books.index');
    }

    public function destroy(Book $book)
    {
        $book->memos()->each(function ($memo) {
            $memo->delete();
        });
        $book->delete();
        session()->flash('flash_message', '書籍を削除しました');

        return redirect()->route('books.index');

    }
}
