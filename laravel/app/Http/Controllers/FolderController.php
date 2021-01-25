<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Folder;
use Illuminate\Support\Facades\Auth;

class FolderController extends Controller
{
    public function showCreateForm()
    {
        return view('folders/create');
    }

    public function create(Folder $folder,Request $request)
    {
        $folder->folder = $request->folder;
        $folder->user_id = 2;
        $folder->save();

        return back();
    }

}
