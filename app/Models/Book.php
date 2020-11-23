<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
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
    public function tags() {
        return $this->belongsToMany('App\Models\Btag');
    }

}
