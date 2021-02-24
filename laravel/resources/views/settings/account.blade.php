@extends('layouts/layout')

@section('title', 'アカウント管理')

@section('styles')
    {{-- @include('libs.flatpickr.styles') --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"> --}}
@endsection

@section('content')

{{ Breadcrumbs::render('user.edit', $user) }}

<section class="conteiner p-3 py-sm-5"
style="background-image: url('https://book-quote.s3-ap-northeast-1.amazonaws.com/layouts/desk.jpg');
background-size: cover;
"
>

    <div class="row justify-content-center py-5">
        <div class="col-md-9 col-sm-11">
            <div class="card" style="opacity: 0.95;">
                <div class="card-header h5">
                    アカウント管理
                </div>

                <div class="card-body p-5">
                    <form method="POST" action="" class="card mx-autop-5 p-5" enctype="multipart/form-data">
                        @method('PATCH')
                        @csrf
                        @include('layouts.errors')
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th class="text-center"><label for="thumb">サムネイル</label></th>
                                    <td>
                                        @if($user->thumbnail === null)
                                        <img class="p-1 mb-3" id="preview" src="https://book-quote.s3-ap-northeast-1.amazonaws.com/layouts/default_user.jpg">
                                        @else
                                        <img class="p-1 mb-3" id="preview" src="{{ $user->thumbnail }}">
                                        @endif

                                        <input type="file" class="form-control p-1 mb-3" id="thumb" name="thumb" accept="image/*" value="{{ old('thumb')}}" onchange="previewImage(this);">
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-center"><label for="name">ユーザー名</label></th>
                                    <td><input type="text" class="form-control" id="name" name="name" value="{{ $user->name ?? old('name') }}"></td>
                                </tr>
                                <tr>
                                    <th class="text-center"><label for="email">メールアドレス</label></th>
                                    <td><input type="text" class="form-control" id="email" name="email" value="{{ $user->email ?? old('email') }}"></td>
                                </tr>
                            </tbody>
                        </table>

                        <input type="submit" class="btn btn-lg btn-outline-success my-4 w-100" value="編集する">

                        <p class="text-right">パスワードの変更は<a href="">コチラ&gt;&gt;</a></p>
                        <p class="text-right"><a class="text-danger" data-id="{{ $user->id }}" onclick="deleteUser(this);">退会する &gt;&gt;</a></p>
                    </form>

                    <form class="deleteform" action="{{ route('user.destroy', ['user' => $user]) }}" method="post" id="delete_user_{{ $user->id }}">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
