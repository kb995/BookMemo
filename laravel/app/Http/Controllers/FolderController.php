<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\FolderRequest;
use App\Models\Folder;
use Illuminate\Support\Facades\Auth;

class FolderController extends Controller
{
    public function showCreateForm()
    {
        return view('folders/create');
    }

    public function create(Folder $folder, FolderRequest $request)
    {
        $folder->name = $request->name;
        $folder->user_id = Auth::id();
        $folder->save();

        session()->flash('flash_message', 'フォルダーを作成しました');

        return back();
    }


}
