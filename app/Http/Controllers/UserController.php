<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\User;

class UserController extends Controller
{
    /**
     * ユーザーの編集画面を表示
     *
     * @param  App\User;
     */
    public function edit(User $user)
    {
        // $this->authorize('update', $user);

        return view('settings.account', compact('user'));
    }

    /**
     * ユーザー情報を編集する
     *
     * @param App\Http\Requests\UserRequest;
     *
     * todo: 画像アップロードをメソッドに
     *       画像パス修正
     *       リクエストをfillに
     *
     */
    public function update(UserRequest $request, User $user)
    {
        // $this->authorize('update', $user);

        // 画像アップロード
        if(is_uploaded_file($_FILES['thumb']['tmp_name'])){
            $upload_image = $request->file('thumb');
            $file_name = time() . '_' . $upload_image->getClientOriginalName();
            $path = $upload_image->storeAs('public/user', $file_name);
            if($path) {
                $user->thumbnail = $file_name;
            }
        }
        // リクエスト取得
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        session()->flash('flash_message', 'アカウント情報を編集しました');

        return redirect()->route('books.index');
    }

}
