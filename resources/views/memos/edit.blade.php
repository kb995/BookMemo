@extends('layouts/layout')

@section('title', 'メモ編集')

@section('styles')
    {{-- @include('libs.flatpickr.styles') --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"> --}}
@endsection

@section('content')
<section class="conteiner">
    <h1 class="text-left w-50 my-5 mx-auto h2">メモ編集</h1>

    @include('layouts.errors')

    <form method="POST" action="" class="card mx-auto w-50 p-5">
    @method('PATCH')
    @csrf
        <div class="form-group">
            <textarea type="text" class="form-control" id="memo" name="memo" onkeyup="strLimit(300);">{{ $memo->memo ?? old('memo') }}</textarea>
            <div class="text-right my-2">
                <span class="post_count">残り文字数 <span id="label">300</span>/300</span>
            </div>
            <input type="submit" class="btn btn-outline-success w-100 my-4" value="編集する">
        </div>
    </form>
    </section>

    <div class="text-center py-1 mt-5">
        Copyright © 2020 ***. All Rights Reserved.
    </div>

@endsection
