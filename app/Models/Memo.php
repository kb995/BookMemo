<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Mtag;

class Memo extends Model
{
    //
    public function tags() {
        return $this->belongsToMany('App\Models\Mtag');
    }
}
