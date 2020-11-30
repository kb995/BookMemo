<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Memo;

class Mtag extends Model
{
    protected $fillable = [
    'name',
];

    public function getHashtagAttribute()
    {
        return '#' . $this->name;
    }

    public function memosCategorized()
    {
        return $this->belongsToMany('App\Models\Memo');
    }

    public function memos()
    {
        return $this->belongsToMany('App\Models\Memo');
    }

    // ★メモタグ取得
    // public static function searchTaggedMemo ($name, $book) {
    //     $tag = self::where('name', $name)->where('book_id', $book)->first();
    //     return $tag->belongsToMany('App\Models\Memo');
    // }
}
