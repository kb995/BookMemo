@extends('layouts/layout')

@section('title', 'フォルダ作成')

@section('styles')
    {{-- @include('libs.flatpickr.styles') --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"> --}}
@endsection

@section('content')

<section class="container">
    <form method="post" class="d-flex align-items-center justify-content-center min-vh-100" action="{{ route('books.folders.store', ['book' => $book]) }}">
        @csrf
        <div class="form-group mx-4 text-center w-75">
            <h2 class="google-search-label mb-4" for="name">フォルダー作成</h2>
            <div class="row">
                <input class="google-search-input col-10" type="text" name="name" value="{{ old('name') }}" placeholder="フォルダー名を入力">
                <input type="submit" class="btn btn-lg btn-primary col-2" value="作成">
            </div>
        </div>
    </form>
</section>

@endsection
