<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\MemoRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Book;
use App\Models\Memo;
use App\Models\Tag;
use App\User;

class MemoController extends Controller
{

    public function store(Book $book, Memo $memo, MemoRequest $request)
    {
        $memo->memo = $request->memo;
        $memo->book_id = $book->id;
        $memo->save();
        session()->flash('flash_message', 'メモを追加しました');

        $request->tags->each(function ($tagName) use ($memo, $book) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $tag->book_id = $book->id;
            $tag->user_id = Auth::id();
            $tag->save();
            $memo->tags()->attach($tag);
        });

        return redirect()->route('books.show', ['book' => $book]);
    }

    public function edit(Book $book, Memo $memo)
    {
        $tagNames = $memo->tags->map(function ($tag) {
            return ['text' => $tag->name];
        });
        $allTagNames = Tag::all()->map(function ($tag) {
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
        $tag = Tag::firstOrCreate(['name' => $tagName]);
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

}
