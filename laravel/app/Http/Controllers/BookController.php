<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use App\Http\Requests\BookRequest;
use App\Models\Book;
use App\Models\Memo;
use App\User;
use Storage;


class BookController extends Controller
{

    /**
     * 書籍一覧を表示する
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * TODO:検索機能をモデルメソッドに
     */
    public function index(Request $request)
    {
        // ユーザー取得
        $user = User::with(['books' => function ($query) {
            $query->where('user_id', Auth::id());
        }])->find(Auth::id());

        // カテゴリーリスト取得
        $category_list = Book::categoryList();
        // 登録書籍カウントリスト取得
        $book_counts = Book::bookCounts();
        // リクエストを変数に格納
        $keyword = $request->keyword;
        $category = $request->category;
        $author = $request->author;
        $isbn = $request->isbn;
        $status = $request->status;

        // キーワード検索
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

        // カテゴリー検索
        // if(!empty($category)) {
        //     $books = $user->books()
        //     ->where('category', $category)
        //     ->orderBy('created_at', 'desc')
        //     ->paginate(12);

        //     session()->forget(['search']);
        //     session()->put('search', $category);
        // }

        // 著者検索
        // if(!empty($author)) {
        //     $books = $user->books()
        //     ->where('author', 'like' , '%'.$author.'%')
        //     ->orderBy('created_at', 'desc')
        //     ->paginate(12);

        //     session()->forget(['search']);
        //     session()->put('search', $author);
        // }

        // ISBN検索
        // if(!empty($isbn)) {
        //     $books = $user->books()
        //     ->where('isbn', $isbn)
        //     ->orderBy('created_at', 'desc')
        //     ->paginate(12);

        //     session()->forget(['search']);
        //     session()->put('search', $isbn);
        // }

        // 書籍状態検索
        // if(!empty($status)) {
        //     $books = $user->books()
        //     ->where('status', $status)
        //     ->orderBy('created_at', 'desc')
        //     ->paginate(12);

        //     session()->forget(['search']);
        //     session()->put('search', $status);
        // }

        // デフォルト時の書籍一覧
        if(empty($books)) {
            $books = $user->books()
            ->orderBy('created_at', 'desc')
            ->paginate(12);
            session()->forget(['search']);
        }

        return view('books.index', compact('books', 'user', 'book_counts', 'category_list'));
    }

    /**
     * 書籍登録画面を表示する
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * 書籍を登録する
     *
     * @param App\Models\Book;
     * @param App\Http\Requests\BookRequest;
     *
     * TODO: 画像アップロードをメソッド化
     */
    public function store(Book $book, BookRequest $request)
    {
        // 画像アップロード処理
        if(is_uploaded_file($_FILES['cover']['tmp_name'])){
            $image = $request->file('cover');
            $path = Storage::disk('s3')->put('/book-cover', $image, 'public');
            $book->cover = Storage::disk('s3')->url($path);
            // $file_name = time() . '_' . $upload_image->getClientOriginalName();
            // $path = $upload_image->storeAs('public/books', $file_name);
        }

        // リクエスト取得 & 保存
        $book->fill($request->all());
        $book->user_id = Auth::id();
        $book->save();

        session()->flash('flash_message', '書籍を登録しました');

        return redirect()->route('books.show', ['book' => $book]);
    }

    /**
     * 書籍詳細を表示する (メモ一覧)
     *
     * @param App\Models\Book;
     * @param  \Illuminate\Http\Request  $request
     *
     * TODO: Request => MemoRequest
     * TODO: 検索機能をメソッドに
     */
    public function show(Book $book, Request $request)
    {
        // 認可
        $this->authorize('view', $book);

        $book = Book::find($book->id);
        // タグ一覧取得
        $tags = Memo::where('book_id', $book->id)->whereNotNull('tag')
                ->get('tag')->unique('tag');
        // リクエスト取得
        $keyword = $request->keyword;
        $tag = $request->tag;

        // キーワード検索
        if(!empty($keyword)) {
            $memos = $book->memos()
            ->where('memo', 'like' , '%'.$keyword.'%')
            ->orderBy('created_at', 'desc')
            ->paginate(12);
            session()->forget(['search']);
            session()->put('search', $keyword);
        }

        // タグ検索
        if(!empty($tag)) {
            $memos = $book->memos()
            ->where('tag', $tag)
            ->orderBy('created_at', 'desc')
            ->paginate(12);
            session()->forget(['tag']);
            session()->put('tag', $tag);
        }

        // デフォルト時メモ一覧
        if(empty($memos)) {
            $memos = $book->memos()
            ->orderBy('created_at', 'desc')
            ->paginate(12);
            session()->forget(['search']);
            session()->forget(['tag']);
        }

        return view('books.show', compact('book', 'memos', 'tags'));
    }

    /**
     * 書籍編集画面を表示する
     *
     * @param App\Models\Book;
     */
    public function edit(Book $book)
    {
        // 認可
        $this->authorize('update', $book);

        return view('books.edit', compact('book'));
    }

    /**
     * 書籍を編集する
     *
     * @param App\Models\Book;
     * @param App\Http\Requests\BookRequest;
     *
     * TODO: 画像アップロードをメソッドに
     */
    public function update(Book $book, BookRequest $request)
    {
        //　認可
        $this->authorize('update', $book);

        // 画像アップロード処理
        if(is_uploaded_file($_FILES['cover']['tmp_name'])){
            $image = $request->file('cover');
            $path = Storage::disk('s3')->put('/book-cover', $image, 'public');
            // $upload_image = $request->file('cover');
            // $file_name = time() . '_' . $upload_image->getClientOriginalName();
            // $path = $upload_image->storeAs('public/books/', $file_name);
            if($book->cover) {
                // $delete_img_path = storage_path() . '/app/public/books/' . $book->cover;
                // \File::delete($delete_img_path);
                // $book->cover = $file_name;
                $disk = Storage::disk('s3');
                $disk->delete('/book-cover/' . basename($book->cover));
            }
        }

        // 保存
        $book->cover = Storage::disk('s3')->url($path);
        $book->fill($request->all());
        $book->save();


        session()->flash('flash_message', '書籍を編集しました');

        return redirect()->route('books.show', ['book' => $book]);
    }

    /**
     * 書籍を削除する
     *
     * @param App\Models\Book;
     *
     * todo:削除先パスの修正
     */
    public function destroy(Book $book)
    {
        // 認可
        $this->authorize('delete', $book);
        // リレーション先(メモ)削除
        $book->memos()->each(function ($memo) {
            $memo->delete();
        });
        // 書籍画像削除
        $disk = Storage::disk('s3');
        $disk->delete('/book-cover/' . basename($book->cover));
        // $book_cover = $book->cover;
        // $delete_img_path = storage_path() . '/app/public/' . $book->cover;
        // \File::delete($delete_img_path);

        $book->delete();

        session()->flash('flash_message', '書籍を削除しました');

        return redirect()->route('books.index');
    }

    public function showSearchForm() {
        return view('books.api_form');
    }

    public function search(Request $request) {
        $keyword = $request->keyword;

        $url = "https://www.googleapis.com/books/v1/volumes?country=JP&maxResults=10&orderBy=relevance&q=${keyword}";
        $json = file_get_contents($url);
        $books = json_decode($json, true);
        $books = $books['items'];

        // $all_num = count($books['items']);
        // $disp_limit = 2;
        // $page = 1;
        // $books = collect($json_decode['items']);
        // dd(collect($books['items']));

        // dd(collect($books['items']));

        // $books = new LengthAwarePaginator(
        //     $books->forPage($request->page, 5),
        //     $all_num,
        //     $disp_limit,
        //     $request->page,
        //     array('path'=> $request->url)
        // );

        session()->forget(['search']);
        session()->put('search', $keyword);

        return view('books.search', compact('books'));
    }
    public function apiRegister(string $book_id, Book $book) {
        $url = "https://www.googleapis.com/books/v1/volumes?country=JP&maxResults=1&orderBy=relevance&q=${book_id}";
        $json = file_get_contents($url);
        $data = json_decode($json, true);
        $data = $data['items'][0]['volumeInfo'];

        // $url = $data['imageLinks']['thumbnail'];
        // $img = file_get_contents($url);
        // $imginfo = pathinfo($url);
        // $img_name = time() .'_'. $data['title'];
        // $path = file_put_contents('./../storage/app/public/upload_books/' . $img_name, $img);

        $book->title = $data['title'];
        $book->author = $data['authors'][0];
        $book->isbn = $data['industryIdentifiers'][0]['identifier'];
        $book->page = $data['pageCount'];
        $book->publisher = $data['publisher'];
        $book->published_at = $data['publishedDate'];
        $book->description = $data['description'];
        $book->user_id = Auth::id();
        // $book->cover = $img_link;
        $book->save();

        session()->flash('flash_message', '書籍を登録しました');

        return redirect()->route('books.show', ['book' => $book]);
    }
}
