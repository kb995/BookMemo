@extends('layouts/layout')

@section('title', 'Googleブックス検索')

@section('styles')
    {{-- @include('libs.flatpickr.styles') --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"> --}}
@endsection

@section('content')

<section class="">
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

<section class="container bg-white pt-3">

    @if (Session::has('search'))
    <p class="h4 text-left card p-2 bg-light">
        「 {{ Session::get('search') }} 」の検索結果
    {{-- 「 {{ Session::get('search') }} 」を表示中 ( {{ $books->firstItem() }} - {{ $books->lastItem() }} /  {{ $books->total() }} 件中 ) --}}
    </p>
    @endif

    @if(!empty($books))
        @foreach ($books as $book)
        <div class="mb-4 p-5 w-75 mx-auto search-results border-bottom">
            <div class="row">
                <div class="col-3 text-center">
                    @if (array_key_exists('imageLinks', $book['volumeInfo']))
                    <p>
                        <img class="shadow" src="{{ $book['volumeInfo']['imageLinks']['thumbnail']}}"><br>
                    </p>
                    @endif

                    <div class="w-75 mx-auto mt-4">
                        <a class="btn btn-sm btn-success w-100">書籍を本棚登録</a>
                        <a class="btn btn-sm my-2bg-warning text-dark w-100" href="https://www.amazon.co.jp/s?k={{ $book['volumeInfo']['title'] }}" target="_blank"><i class="fab fa-amazon pr-1"></i>Amazonで購入</a>
                    </div>

                </div>
                <div class="col-9 px-2">
                    @if (array_key_exists('title', $book['volumeInfo']))
                    <h3 class="mb-2">{{ $book['volumeInfo']['title'] }}</h3>
                    @endif

                    @if (array_key_exists('authors', $book['volumeInfo']))
                        <p class="mb-1"><span class="font-weight-bold">著者:</span> {{ $book['volumeInfo']['authors'][0] }}</p>
                    @endif

                    @if (array_key_exists('publisher', $book['volumeInfo']))
                        <p class="mb-1"><span class="font-weight-bold">出版社:</span> {{ $book['volumeInfo']['publisher'] }}</p>
                    @endif

                    @if (array_key_exists('publishedDate', $book['volumeInfo']))
                        <p class="mb-1"><span class="font-weight-bold">発売年月: </span>{{ str_replace( '-' , '/' ,$book['volumeInfo']['publishedDate'])}}</p>
                    @endif
                    @if (array_key_exists('pageCount', $book['volumeInfo']))
                        <p class="mb-1"><span class="font-weight-bold">ページ: </span>{{ $book['volumeInfo']['pageCount'] }}</p>
                    @endif

                    @if (array_key_exists('description', $book['volumeInfo']))
                        <p class="mb-1 text-justify"><span class="font-weight-bold">概要: </span> {{ $book['volumeInfo']['description'] }}</p>
                    @endif
                </div>
            </div>

        </div>
        @endforeach
    @endif
</section>

@if(!empty($books))
{{-- {{ $books->links() }} --}}
@endif

@endsection
