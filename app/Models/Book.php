<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Memo;

class Book extends Model
{
    public function memos() {
        return $this->hasMany('App\Models\Memo', 'book_id');
    }
    public function booksCount() {
        return $this->count();
    }
}
