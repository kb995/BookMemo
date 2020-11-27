<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Models\Memo;
use App\Models\Btag;


class Book extends Model
{
    public function memos() {
        return $this->hasMany('App\Models\Memo', 'book_id');
    }

    public function booksCount() {
        return $this->count();
    }

    public function booksReadCount() {
        return $this->where('status', 4)->count();
    }

     static public function category_list() {
        $category = Book::where('user_id', Auth::id())->get();
        $category_list = $category->unique('category');

        return $category_list;
    }
}
