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

    public function memos()
    {
        return $this->belongsToMany('App\Models\Memo');
    }
}
