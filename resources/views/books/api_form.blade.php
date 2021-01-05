@extends('layouts/layout')

@section('title', 'API検索フォーム')

@section('styles')
    {{-- @include('libs.flatpickr.styles') --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"> --}}
@endsection

@section('content')

<section class="shelf-serach w-75 mx-auto">
    <form method="POST" action="" class="text-center my-3 mx-auto pt-5">
        @csrf
        <div class="form-group ml-3">
            <h2 class="google-search-label block" for="keyword">GoogleBooksから探す</h2>
            <input class="google-search-input mt-4" type="text" name="keyword" value="{{ old('keyword') }}" placeholder="キーワードを入力">
            <input type="submit" class="btn btn-lg btn-primary" value="検索">
        </div>
    </form>
</section>

@endsection
