<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Memo;
use App\User;


class MemoController extends Controller
{

    // public function index()
    // {
    //     //
    // }


    // public function create()
    // {
    //     return view('memos.create');
    // }


    public function store(Book $book, Memo $memo, Request $request)
    {
        $memo->memo = $request->memo;

        return redirect()->route('books.show', ['book' => $book]);
    }


    public function show($id)
    {
        //
    }


    public function edit(Book $book, Memo $memo)
    {
        return view('memos.edit', compact('book', 'memo'));
    }


    public function update(Request $request, Book $book, Memo $memo)
    {
        $memo->memo = $request->memo;

        $memo->save();

        return redirect()->route('books.show', ['book' => $book]);
    }


    public function destroy($id)
    {
        //
    }
}
