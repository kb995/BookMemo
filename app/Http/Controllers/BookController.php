<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\BookRequest;
use App\Models\Book;
use App\Models\Memo;
use App\Models\Mtag;
use App\User;



class BookController extends Controller
{
    public function index()
    {
        $user = User::find(Auth::id());
        $books = $user->books()->orderBy('created_at', 'desc')->paginate(12);
        $category_list = Book::categoryList();
        $book_counts = Book::bookCounts();

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
        $book->title = $request->title;
        $book->author = $request->author;
        $book->isbn = $request->isbn;
        $book->description = $request->description;
        $book->category = $request->category;
        $book->status = $request->status;
        $book->read_at = $request->read_at;
        $book->user_id = Auth::id();
        $book->save();
        session()->flash('flash_message', '書籍を登録しました');

        return redirect()->route('books.show', ['book' => $book]);
    }

    public function show(Book $book, Request $request)
    {
        $book = Book::find($book->id);
        $keyword = $request->keyword;
        $mtag = $request->mtag;

        if(!empty($keyword)) {
            $memos = $book->memos()
            ->where('memo', 'like' , '%'.$keyword.'%')
            ->orderBy('created_at', 'desc')
            ->paginate(12);
            // session()->forget(['search_keyword', 'search_mtag']);
            // session()->put('search_keyword', $keyword);
        }

        // if(!empty($mtag)) {
        //     $memos = $book->memos()
        //     ->where('category', 'like' , '%'.$category.'%')
        //     ->orderBy('created_at', 'desc')
        //     ->paginate(12);
            // session()->forget(['search_keyword', 'search_mtag']);
            // session()->put('search_keyword', $keyword);

            // タグキーワードで検索 & ユーザidが一致 & ほしいのはメモ
            // 1)キーワードでタグ検索
            // 2)
            // 3)メモ取得
            // $aaa = Mtag::searchTaggedMemo($mtag, $book->id);
            // dd($aaa);
        // }

        if(empty($memos)) {
            $memos = $book->memos()
            ->orderBy('created_at', 'desc')
            ->paginate(12);
        }

        // ************************************************
        // タグ修正
        // $allTagNames = Mtag::all()->map(function ($tag) {
        //     return ['text' => $tag->name];
        // });

        // 他ユーザーのものが出ないようにする
        // mtag create時にbook_idをもたせる ★
        // 取得の際ユーザーに紐付いたbook_idで絞る

        // (仮機能)タグ検索に必要なので単純にタグを取ってbladeに渡す
        // $bookTags = Mtag::where('book_id', $book->id)->get();
        // dd($bookTags);
        // Vueコンポーネントに渡す時にbook_idも同時に入れる
        // ************************************************

        $memoTags = Mtag::where('book_id', $book->id)->get();
        // $allTagNames = Mtag::where('book_id', $book->id)->get()->map(function ($tag) {
        //     return ['text' => $tag->name];
        // });
        session()->forget(['search_keyword', 'search_mtag']);

        return view('books.show', compact('book', 'memos', 'memoTags'));
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
        $book->category = $request->category;
        $book->status = $request->status;
        $book->rank = $request->rank;
        $book->read_at = $request->read_at;
        $book->save();
        session()->flash('flash_message', '書籍を編集しました');

        return redirect()->route('books.show', ['book' => $book]);
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

    // 書籍検索
    public function search(Book $book, Request $request) {
        $user = User::find(Auth::id());
        $category_list = Book::categoryList();
        $book_counts = Book::bookCounts();
        $keyword = $request->keyword;
        $category = $request->category;

        if(!empty($keyword)) {
            $books = $user->books()
            ->where('title', 'like' , '%'.$keyword.'%')
            ->orWhere('author', 'like' , '%'.$keyword.'%')
            ->orWhere('description', 'like' , '%'.$keyword.'%')
            ->orderBy('created_at', 'desc')
            ->paginate(12);

            // session()->forget(['search_keyword', 'search_mtag']);
            // session()->put('search_keyword', $keyword);
        }

        if(!empty($category)) {
            $books = $user->books()
            ->where('category', $category)
            ->orderBy('created_at', 'desc')
            ->paginate(12);

            // session()->forget(['search_keyword', 'search_mtag']);
            // session()->put('search_keyword', $keyword);
        }

        if(empty($books)) {
            $books = $user->books()
            ->orderBy('created_at', 'desc')
            ->paginate(12);
        }

        return view('books.index', compact('books', 'user', 'book_counts', 'category_list'));
    }
}
