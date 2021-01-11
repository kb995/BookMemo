<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Models\Memo;
use App\User;


const BOOK_STATUS_UNREAD = 1;
const BOOK_STATUS_READING = 2;
const BOOK_STATUS_PILE = 3;
const BOOK_STATUS_READ = 4;



class Book extends Model
{

    protected $fillable = [
        'title',
        'cover',
        'author',
        'isbn',
        'page',
        'publisher',
        'published_at',
        'description',
        'category',
        'status',
        'rank',
        'read_at',
        ];

    public function memos() {
        return $this->hasMany('App\Models\Memo', 'book_id');
    }

    public static function bookCounts() {
        $user = User::find(Auth::id());
        $counts = [];
        $counts['books_all'] = Book::where('user_id', $user->id)->count();
        $counts['books_unread'] = Book::where('user_id', $user->id)->where('status', BOOK_STATUS_UNREAD)->count();
        $counts['books_reading'] = Book::where('user_id', $user->id)->where('status', BOOK_STATUS_READING)->count();
        $counts['books_pile'] = Book::where('user_id', $user->id)->where('status', BOOK_STATUS_PILE)->count();
        $counts['books_read'] = Book::where('user_id', $user->id)->where('status', BOOK_STATUS_READ)->count();

        return $counts;
    }

     static public function categoryList() {
        $category = Book::where('user_id', Auth::id())->get();
        $category_list = $category->unique('category');

        return $category_list;
    }

    public function getMemoCountAttribute() {
        $book = Book::find($this->id);
        $count = Memo::where('book_id', (int)$book->id)->count();
        return $count;
    }

}
