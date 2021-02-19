<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use App\Http\Requests\BookRequest;
use App\Http\Requests\MemoRequest;
use App\Models\Book;
use App\Models\Memo;
use App\Models\Folder;
use App\User;
use Storage;


class BookController extends Controller
{

    /**
     * 書籍一覧を表示する
     *
     * @param  \Illuminate\Http\Request $request
     *
     */
    public function index(Request $request)
    {
        // ユーザー取得
        $user = User::with(['books' => function ($query) {
            $query->where('user_id', Auth::id());
        }])->find(Auth::id());

        // 登録書籍カウントリスト取得
        $book_counts = Book::bookCounts();

        // リクエストを変数に格納
        $keyword = $request->keyword;
        if(!empty($_GET['status'])) {
            $book_status = $_GET['status'];
        }

        // 本棚キーワード検索
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

        // 本棚ステータス検索
        if(!empty($book_status)) {
            $books = $user->books()
            ->where('status', $book_status)
            ->orderBy('created_at', 'desc')
            ->paginate(12);
        }

        // デフォルト時の書籍一覧
        if(empty($books)) {
            $books = $user->books()
            ->orderBy('created_at', 'desc')
            ->paginate(12);
            session()->forget(['search']);
        }

        return view('books.index', compact('books', 'user', 'book_counts'));
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
     */
    public function store(Book $book, BookRequest $request)
    {
        // 画像アップロード処理
        if(is_uploaded_file($_FILES['img_url']['tmp_name'])){
            $image = $request->file('img_url');
            $path = Storage::disk('s3')->put('/book-cover', $image, 'public');
            $book->img_url = Storage::disk('s3')->url($path);
        } elseif($request->img_url) {
            $book->img_url = $request->img_url;
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
     * @param  \Illuminate\Http\Request $request
     *
     */

    public function show(Book $book, Request $request)
    {
        // 認可
        $this->authorize('view', $book);

        $book = Book::find($book->id);

        // フォルダーリスト取得
        session()->forget(['current_folder']);
        $folders = Folder::where('user_id', Auth::id())->where('book_id', $book->id)->get();

        // リクエスト取得
        $keyword = $request->keyword;
        $current_folder = $request->current_folder;

        // メモキーワード検索
        if(!empty($keyword)) {
            $memos = $book->memos()
            ->where('memo', 'like' , '%'.$keyword.'%')
            ->orderBy('created_at', 'desc')
            ->paginate(12);
            session()->forget(['search']);
            session()->put('search', $keyword);
        }

        // フォルダー選択
        if(!empty($current_folder)) {
            $memos = $book->memos()
            ->where('folder', $current_folder)
            ->orderBy('created_at', 'desc')
            ->paginate(12);
            session()->forget(['current_folder']);
            session()->put('current_folder', $current_folder);
        }

        // デフォルト時メモ一覧
        if(empty($memos)) {
            $memos = $book->memos()
            ->orderBy('created_at', 'desc')
            ->paginate(12);
            session()->forget(['search']);
            session()->forget(['folder']);
        }

        return view('books.show', compact('book', 'memos', 'folders'));
    }

    /**
     * 書籍編集画面を表示する
     *
     * @param App\Models\Book;
     */

    public function edit(Book $book)
    {
        $this->authorize('update', $book);

        return view('books.edit', compact('book'));
    }

    /**
     * 書籍を編集する
     *
     * @param App\Models\Book;
     * @param App\Http\Requests\BookRequest;
     *
     */
    public function update(Book $book, BookRequest $request)
    {
        $this->authorize('update', $book);

        // 画像アップロード処理
        if(is_uploaded_file($_FILES['cover']['tmp_name'])){
            $image = $request->file('cover');
            $path = Storage::disk('s3')->put('/book-cover', $image, 'public');
            if($book->cover) {
                $disk = Storage::disk('s3');
                $disk->delete('/book-cover/' . basename($book->cover));
            }
        }

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
     */
    public function destroy(Book $book)
    {
        $this->authorize('delete', $book);

        // リレーション先(メモ)削除
        $book->memos()->each(function ($memo) {
            $memo->delete();
        });

        // 書籍画像削除
        $disk = Storage::disk('s3');
        $disk->delete('/book-cover/' . basename($book->cover));
        $book->delete();

        session()->flash('flash_message', '書籍を削除しました');

        return redirect()->route('books.index');
    }

    /**
     * GoogleAPI検索フォームを表示する
     */

    public function showSearchForm() {
        return view('books.api_form');
    }

    /**
     * API検索結果を表示する
     */

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

    /**
     * API情報から書籍登録時のフォームを表示
     */

    public function showApiCreate(string $book_id) {
        $url = "https://www.googleapis.com/books/v1/volumes?country=JP&maxResults=1&orderBy=relevance&q=${book_id}";
        $json = file_get_contents($url);
        $data = json_decode($json, true);
        $result = $data['items'][0]['volumeInfo'];
        if(isset($result['imageLinks']['thumbnail'])) {
            $img = $result['imageLinks']['thumbnail'];
        }else{
            $img = '';
        }

        return view('books.create_api', compact('result','img'));
    }

    /**
     * API情報から書籍を登録する
     *
     * @param App\Models\Book;
     *
     */

    public function storeApi(BookRequest $request, Book $book) {

        $book->fill($request->all());
        $book->user_id = Auth::id();
        $book->save();

        session()->flash('flash_message', '書籍を登録しました');

        return redirect()->route('books.show', ['book' => $book]);

    }
}
