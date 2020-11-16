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
        $books = $user->books()->orderBy('created_at', 'desc')->paginate(12);

        return view('books.index', compact('books', 'user'));
    }

    public function create()
    {
        return view('books.create');
    }

    public function store(Book $book, BookRequest $request)
    {
        if(is_uploaded_file($_FILES['cover']['tmp_name'])){
            $upload_image = $request->file('cover');
            $file_name = time() . '_' . $upload_image->getClientOriginalName();
            $path = $upload_image->storeAs('public', $file_name);
            if($path) {
                $book->cover = $file_name;
            }
        }
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
        $book = Book::find($book->id);
        $memos = $book->memos()->orderBy('id', 'desc')->paginate(10);

        return view('books.show', compact('book', 'memos'));
    }

    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    public function update(Book $book, BookRequest $request)
    {
        if(is_uploaded_file($_FILES['cover']['tmp_name'])){
            $upload_image = $request->file('cover');
            $file_name = time() . '_' . $upload_image->getClientOriginalName();
            $path = $upload_image->storeAs('public', $file_name);
            if($path) {
                $delete_img_path = storage_path() . '/app/public/' . $book->cover;
                \File::delete($delete_img_path);
                $book->cover = $file_name;
            }
        }
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
        $book_cover = $book->cover;
        $delete_img_path = storage_path() . '/app/public/' . $book->cover;
        \File::delete($delete_img_path);
        $book->delete();
        session()->flash('flash_message', '書籍を削除しました');

        return redirect()->route('books.index');

    }
}
