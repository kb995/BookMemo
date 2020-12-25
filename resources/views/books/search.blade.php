@extends('layouts/layout')

@section('title', 'Googleブックス検索')

@section('styles')
    {{-- @include('libs.flatpickr.styles') --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"> --}}
@endsection

@section('content')

<section class="shelf-serach" style="border-color: blue;">
    <form method="POST" action="{{ route('books.search') }}" class="text-center my-3">
        @csrf
        <div class="form-group ml-3">
            <label class="shelf-serach-label block" for="keyword">Googleから探す</label>
            {{-- <input type="hidden" name="page" value="{{ $pages->currentPage ?? 1 }}"> --}}
            <input class="shelf-serach-input" type="text" name="keyword" value="{{ old('keyword') }}" placeholder="キーワードで検索">
            <input type="submit" class="shelf-serach-btn" value="検索" style="background-color: blue;">
        </div>
    </form>
</section>

<section class="book-shelf">
    @if(!empty($books))
    @foreach ($books as $book)
    <div class="card my-4 p-5">

        @if (array_key_exists('imageLinks', $book['volumeInfo']))
        <p class="img-thumbnail d-inline">
            <img src="{{ $book['volumeInfo']['imageLinks']['thumbnail']}}"><br>
        </p>
        @endif

        @if (array_key_exists('title', $book['volumeInfo']))
        <h4>{{ $book['volumeInfo']['title'] }}</h4>
        @endif

        @if (array_key_exists('authors', $book['volumeInfo']))
            <p>著者: {{ $book['volumeInfo']['authors'][0] }}</p>
        @endif

        @if (array_key_exists('publisher', $book['volumeInfo']))
            <p>出版社: {{ $book['volumeInfo']['publisher'] }}</p>
        @endif

        @if (array_key_exists('publishedDate', $book['volumeInfo']))
            <p>発売年月：{{ $book['volumeInfo']['publishedDate']}}</p>
        @endif

        @if (array_key_exists('description', $book['volumeInfo']))
            <p>概要: {{ $book['volumeInfo']['description'] }}</p>
        @endif
    </div>
    @endforeach
    @endif
</section>

@if(!empty($books))
{{-- {{ $books->links() }} --}}
@endif


    <div class="text-center py-1 mt-5">
        Copyright © 2020 ***. All Rights Reserved.
    </div>
@endsection
