<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\Memo;
use App\Models\Folder;

class Memo extends Model
{
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function folder() {
        return $this->hasOne('App\Models\Folder', 'folder_id');
    }

}
