<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Tag;

class Memo extends Model
{
    public function tags() {
        return $this->belongsToMany('App\Models\Tag');
    }
}
