@extends('layouts/layout')

@section('title', 'Googleブックス検索')

@section('styles')
    {{-- @include('libs.flatpickr.styles') --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"> --}}
@endsection

@section('content')

{{-- <section class="">
    <form method="POST" action="{{ route('books.search') }}" class="text-center my-3">
        @csrf
        <div class="form-group ml-3">
            <label class="shelf-serach-label block" for="keyword">Googleから探す</label> --}}
            {{-- <input type="hidden" name="page" value="{{ $pages->currentPage ?? 1 }}"> --}}
            {{-- <input class="shelf-serach-input" type="text" name="keyword" value="{{ old('keyword') }}" placeholder="キーワードで検索">
            <input type="submit" class="shelf-serach-btn" value="検索" style="background-color: blue;">
        </div>
    </form>
</section> --}}

<section class="container bg-white">
    @if(!empty($books))
        @foreach ($books as $book)
        <div class="mb-4 p-5 w-75 mx-auto search-results border-bottom">
            <div class="row">
                <div class="col-3 text-center">
                    @if (array_key_exists('imageLinks', $book['volumeInfo']))
                    <p>
                        <img src="{{ $book['volumeInfo']['imageLinks']['thumbnail']}}"><br>
                    </p>
                    @endif

                    <button class="btn btn-warning my-3">Amazon</button>
                    <button class="btn btn-success">この書籍を本棚登録</button>

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
