<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mtag extends Model
{
    protected $fillable = [
        'name',
    ];

    public function getHashtagAttribute()
    {
        return '#' . $this->name;
    }
}
