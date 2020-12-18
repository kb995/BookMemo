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
    public function index(Request $request)
    {
        $user = User::with(['books' => function ($query) {
            $query->where('user_id', Auth::id());
        }])->find(Auth::id());

        $category_list = Book::categoryList();
        $book_counts = Book::bookCounts();

        $keyword = $request->keyword;
        $category = $request->category;
        $author = $request->author;
        $isbn = $request->isbn;
        $status = $request->status;

        if(!empty($keyword)) {
            $books = $user->books()
            ->where('title', 'like' , '%'.$keyword.'%')
            ->orWhere('author', 'like' , '%'.$keyword.'%')
            ->orWhere('description', 'like' , '%'.$keyword.'%')
            ->orderBy('created_at', 'desc')
            ->paginate(12);

            session()->forget(['search']);
            session()->put('search', $keyword);
        }

        if(!empty($category)) {
            $books = $user->books()
            ->where('category', $category)
            ->orderBy('created_at', 'desc')
            ->paginate(12);

            session()->forget(['search']);
            session()->put('search', $category);
        }

        if(!empty($author)) {
            $books = $user->books()
            ->where('author', 'like' , '%'.$author.'%')
            ->orderBy('created_at', 'desc')
            ->paginate(12);

            session()->forget(['search']);
            session()->put('search', $author);
        }

        if(!empty($isbn)) {
            $books = $user->books()
            ->where('isbn', $isbn)
            ->orderBy('created_at', 'desc')
            ->paginate(12);

            session()->forget(['search']);
            session()->put('search', $isbn);
        }

        if(!empty($status)) {
            $books = $user->books()
            ->where('status', $status)
            ->orderBy('created_at', 'desc')
            ->paginate(12);

            session()->forget(['search']);
            session()->put('search', $status);
        }

        if(empty($books)) {
            $books = $user->books()
            ->orderBy('created_at', 'desc')
            ->paginate(12);
            session()->forget(['search']);
        }

        return view('books.index', compact('books', 'user', 'book_counts', 'category_list'));
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

        $book->fill($request->all());
        $book->user_id = Auth::id();
        $book->save();

        session()->flash('flash_message', '書籍を登録しました');

        return redirect()->route('books.show', ['book' => $book]);
    }

    public function show(Book $book, Request $request)
    {
        $this->authorize('view', $book);

        $book = Book::find($book->id);
        $tags = Memo::where('book_id', $book->id)->whereNotNull('tag')
                ->get('tag')->unique('tag');
        $keyword = $request->keyword;
        $tag = $request->tag;

        if(!empty($keyword)) {
            $memos = $book->memos()
            ->where('memo', 'like' , '%'.$keyword.'%')
            ->orderBy('created_at', 'desc')
            ->paginate(12);
            session()->forget(['search']);
            session()->put('search', $keyword);
        }

        if(!empty($tag)) {
            $memos = $book->memos()
            ->where('tag', $tag)
            ->orderBy('created_at', 'desc')
            ->paginate(12);
            session()->forget(['tag']);
            session()->put('tag', $tag);
        }

        if(empty($memos)) {
            $memos = $book->memos()
            ->orderBy('created_at', 'desc')
            ->paginate(12);
            session()->forget(['search']);
            session()->forget(['tag']);
        }

        return view('books.show', compact('book', 'memos', 'tags'));
    }

    public function edit(Book $book)
    {
        $this->authorize('update', $book);
        return view('books.edit', compact('book'));
    }

    public function update(Book $book, BookRequest $request)
    {

        $this->authorize('update', $book);

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

        $book->fill($request->all());
        $book->save();

        session()->flash('flash_message', '書籍を編集しました');

        return redirect()->route('books.show', ['book' => $book]);
    }

    public function destroy(Book $book)
    {
        $this->authorize('delete', $book);

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
