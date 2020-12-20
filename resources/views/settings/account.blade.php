@extends('layouts/layout')

@section('title', 'アカウント管理')

@section('styles')
    {{-- @include('libs.flatpickr.styles') --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"> --}}
@endsection

@section('content')
<section class="conteiner">
    <h1 class="text-left w-50 my-5 mx-auto h2">アカウント管理</h1>

    @include('layouts.errors')

    <form method="POST" action="" class="card mx-auto w-50 p-5" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th><label for="thumb">サムネイル</label></th>
                    <td><input type="file" class="form-control p-1 mb-3" id="thumb" name="thumb" accept="image/png,image/jpeg" value="{{ old('thumb')}}"></td>
                </tr>
                {{--  <tr>
                    <th><label for="cover">表紙</label></th>
                    <td><input type="file" class="form-control p-1 mb-3" id="cover" name="cover" accept="image/png,image/jpeg" value="{{ old('cover')}}"></td>
                </tr>  --}}
                <tr>
                    <th><label for="name">ユーザー名</label></th>
                    <td><input type="text" class="form-control" id="name" name="name" value="{{ $user->name ?? old('name') }}"></td>
                </tr>
                <tr>
                    <th><label for="email">メールアドレス</label></th>
                    <td><input type="text" class="form-control" id="email" name="email" value="{{ $user->email ?? old('email') }}"></td>
                </tr>
            </tbody>
        </table>
        <p class="text-right">パスワードの変更は<a href="">コチラ</a></p>
        <input type="submit" class="btn btn-outline-success my-4" value="編集する">
    </form>
</section>

<div class="text-center py-1 mt-5">
    Copyright © 2020 ***. All Rights Reserved.
</div>
@endsection
