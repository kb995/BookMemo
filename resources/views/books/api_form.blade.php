@extends('layouts/layout')

@section('title', 'API検索フォーム')

@section('styles')
    {{-- @include('libs.flatpickr.styles') --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"> --}}
@endsection

@section('content')

<section class="shelf-serach" style="border-color: blue;">
    <form method="POST" action="{{ route('books.api') }}" class="text-center my-3">
        @csrf
        <div class="form-group ml-3">
            <label class="shelf-serach-label block" for="keyword">Googleから探す</label>
            <input class="shelf-serach-input" type="text" name="keyword" value="{{ old('keyword') }}" placeholder="キーワードで検索">
            <input type="submit" class="shelf-serach-btn" value="検索" style="background-color: blue;">
        </div>
    </form>
</section>

@endsection
