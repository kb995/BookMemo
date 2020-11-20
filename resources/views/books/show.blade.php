@extends('layouts/layout')

@section('title', '書籍詳細')

@section('styles')
    {{-- @include('libs.flatpickr.styles') --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"> --}}
@endsection

@section('content')

<section>
    <div class="row">
        <div class="side col-md-3 col-sm-12">

            @if($book->cover)
            {{-- <a href="{{ route('books.show', ['book' => $book]) }}"> --}}
                <div class="book-cover">
                    <img src="{{ asset('/storage/'. $book->cover) }}">
                </div>
            {{-- </a> --}}
            @else
            {{-- <a href="{{ route('books.show', ['book' => $book]) }}"> --}}
                <div class="book-cover">
                    <i class="book-default fas fa-book"></i>
                </div>
            {{-- </a> --}}
            @endif

            <div class="book-edit">
                <a class="btn btn-info" href="{{ route('books.edit', ['book' => $book]) }}">編集</a>
                <form class="deleteform" action="{{ route('books.destroy', ['book' => $book]) }}" method="post" id="delete_book_{{ $book->id }}">
                    @csrf
                    @method('DELETE')
                    <a class="btn btn-danger" data-id="{{ $book->id }}" onclick="deleteBook(this);">
                        <i class="fas fa-trash-alt pr-1"></i>
                        削除
                    </a>
                </form>
            </div>

            <div class="book-info">
                <p>[タイトル] {{ $book->title }} </p>
                <p>[著者]{{ $book->author }}</p>
                <p>[詳細]{{ $book->description }}</p>
                <p>[isbn]{{ $book->isbn }}</p>
                <p>[状態]{{ $book->status }}</p>
                <p>[タグ]</p>
                <p>[評価]<span class="star">★★★★★</span></p>
                <p>[読了日]{{ $book->read_at }}</p>
            </div>
        </div>

        <div class="memos col-md-9 col-sm-12">

            @include('layouts.errors')

            @include('memos.create')

            @include('memos.index')
        </div>
    </div>
</section>
@endsection
