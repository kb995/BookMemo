@extends('layouts/layout')

@section('title', 'Googleブックス検索')

@section('styles')
    {{-- @include('libs.flatpickr.styles') --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"> --}}
@endsection

@section('content')

<section class="container">
    <h3 class="mt-5 p-2 text-center" for="keyword">Googleから探す</h3>
        <form method="POST" action="{{ route('books.search') }}" class="text-center">
            @csrf
            <div class="form-group row justify-content-center mx-3 mb-5">
                <input class="google-search-input col-9 col-md-6" type="text" name="keyword" value="{{ old('keyword') }}" placeholder="キーワードで検索">
                <input type="submit" class="google-search-btn col-2 col-md-1 ml-1" value="検索">
            </div>
        </form>
</section>

<section class="container bg-white p-5">

    @if (Session::has('search'))
    <p class="h4 text-left card p-3 bg-light">
        「 {{ Session::get('search') }} 」の検索結果
    </p>
    @endif

    @if(!empty($books))
        @foreach ($books as $book)
        <div class="mb-4 p-5 mx-auto search-results border-bottom">
            <div class="row">
                <div class="col-md-4 text-center">
                    @if (array_key_exists('imageLinks', $book['volumeInfo']))
                    <p>
                        <img class="shadow" src="{{ $book['volumeInfo']['imageLinks']['thumbnail']}}"><br>
                    </p>
                    @endif

                    <div class="w-100 mx-auto mt-4">
                        <a class="btn mt-5 btn-success w-100" href="{{ route('books.apiRegister', [ 'book_id' => $book['id'] ]) }}">書籍を本棚登録</a>
                        <a class="btn mt-3 bg-warning text-dark w-100" href="https://www.amazon.co.jp/s?k={{ $book['volumeInfo']['title'] }}" target="_blank"><i class="fab fa-amazon pr-1"></i>Amazonで購入</a>
                    </div>

                </div>

                <div class="col-md-8 pl-4">
                    @if (array_key_exists('title', $book['volumeInfo']))
                    <h3 class="mb-4 pt-4 pt-md-0">{{ $book['volumeInfo']['title'] }}</h3>
                    @endif

                    @if (array_key_exists('authors', $book['volumeInfo']))
                        <p class="mb-2"><span class="font-weight-bold">著者:</span> {{ $book['volumeInfo']['authors'][0] }}</p>
                    @endif

                    @if (array_key_exists('publisher', $book['volumeInfo']))
                        <p class="mb-2"><span class="font-weight-bold">出版社:</span> {{ $book['volumeInfo']['publisher'] }}</p>
                    @endif

                    @if (array_key_exists('publishedDate', $book['volumeInfo']))
                        <p class="mb-2"><span class="font-weight-bold">発売年月: </span>{{ str_replace( '-' , '/' ,$book['volumeInfo']['publishedDate'])}}</p>
                    @endif
                    @if (array_key_exists('pageCount', $book['volumeInfo']))
                        <p class="mb-2"><span class="font-weight-bold">ページ: </span>{{ $book['volumeInfo']['pageCount'] }}</p>
                    @endif

                    @if (array_key_exists('description', $book['volumeInfo']))
                        <p class="mb-2 text-justify"><span class="font-weight-bold">概要: </span> {{ $book['volumeInfo']['description'] }}</p>
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
