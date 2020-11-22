<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\MemoRequest;
use App\Models\Book;
use App\Models\Memo;
use App\Models\Mtag;
use App\User;


class MemoController extends Controller
{

    public function store(Book $book, Memo $memo, MemoRequest $request)
    {
        $memo->memo = $request->memo;
        $memo->book_id = $book->id;
        $memo->save();
        session()->flash('flash_message', 'メモを追加しました');

        $request->tags->each(function ($tagName) use ($memo) {
            $tag = Mtag::firstOrCreate(['name' => $tagName]);
            $memo->tags()->attach($tag);
        });

        return redirect()->route('books.show', ['book' => $book]);
    }

    public function edit(Book $book, Memo $memo)
    {
        $tagNames = $memo->tags->map(function ($tag) {
            return ['text' => $tag->name];
        });
        $allTagNames = Mtag::all()->map(function ($tag) {
            return ['text' => $tag->name];
        });

        return view('memos.edit', compact('book', 'memo', 'tagNames', 'allTagNames'));
    }

    public function update(MemoRequest $request, Book $book, Memo $memo)
    {
        $memo->memo = $request->memo;
        $memo->save();
        session()->flash('flash_message', 'メモを編集しました');

        $memo->tags()->detach();
        $request->tags->each(function ($tagName) use ($memo) {
        $tag = Mtag::firstOrCreate(['name' => $tagName]);
        $memo->tags()->attach($tag);
        });

        return redirect()->route('books.show', ['book' => $book]);
    }


    public function destroy(Book $book, Memo $memo)
    {
        $memo->delete();
        session()->flash('flash_message', 'メモを削除しました');

        return redirect()->route('books.show', ['book' => $book]);
    }

    public function searchTags(Book $book, Mtag $mtag)
    {
        $book = Book::find($book->id);
        $memos = $mtag->memos()->where('book_id', $book->id)->orderBy('id', 'desc')->paginate(12);
        $allTagNames = Mtag::all()->map(function ($tag) {
            return ['text' => $tag->name];
        });
        // (仮機能)タグ検索に必要なので単純にタグを取ってbladeに渡す
        // $bookTags = Mtag::where('book_id', $book->id)->get();
        $bookTags = Mtag::all();

        session()->forget(['search_keyword', 'search_mtag']);
        session()->put('search_mtag', "#" . $mtag->name);
        return view('books.show', compact('book', 'memos', 'allTagNames', 'bookTags'));
    }

    // キーワード検索
    public function searchKeyword(Book $book, Request $request) {
        $book = Book::find($book->id);
        $keyword = $request->keyword;

        if(!empty($keyword)) {
            $memos = Memo::where('memo', 'like' , '%'.$keyword.'%')->paginate(12);
            session()->forget(['search_keyword', 'search_mtag']);
            session()->put('search_keyword', $keyword);
        }

        // タグ(仮)
        $allTagNames = Mtag::all()->map(function ($tag) {
            return ['text' => $tag->name];
        });
        $bookTags = Mtag::all();

        return view('books.show', compact('book', 'memos', 'allTagNames', 'bookTags'));

    }
}
