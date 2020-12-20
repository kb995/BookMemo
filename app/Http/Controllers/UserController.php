<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\User;

class UserController extends Controller
{
    public function edit(User $user)
    {
        // $this->authorize('update', $user);

        return view('settings.account', compact('user'));
    }

    public function update(UserRequest $request, User $user)
    {
        // $this->authorize('update', $user);

        if(is_uploaded_file($_FILES['thumb']['tmp_name'])){
            $upload_image = $request->file('thumb');
            $file_name = time() . '_' . $upload_image->getClientOriginalName();
            $path = $upload_image->storeAs('public/user', $file_name);
            if($path) {
                $user->thumbnail = $file_name;
            }
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        session()->flash('flash_message', 'アカウント情報を編集しました');

        return redirect()->route('books.index');
    }

}
