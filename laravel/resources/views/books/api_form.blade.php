@extends('layouts/layout')

@section('title', 'API検索フォーム')

@section('styles')

@section('content')

<section class="container">
    <form method="POST" action="" class="d-flex align-items-center justify-content-center min-vh-100">
        @csrf
        <div class="form-group mx-4 text-center w-75">
            <h2 class="google-search-label mb-4" for="keyword">GoogleBooksから探す</h2>
            <div class="row">
                <input class="google-search-input col-10" type="text" name="keyword" value="{{ old('keyword') }}" placeholder="キーワードを入力">
                <input type="submit" class="btn btn-lg btn-primary col-2" value="検索">
            </div>
        </div>
    </form>
</section>

@endsection
