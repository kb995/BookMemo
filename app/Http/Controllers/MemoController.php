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


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
