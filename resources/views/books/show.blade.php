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
                <div class="text-left my-2">
                    @if($book->status === 0)
                    <span class="badge badge-secondary p-2">ステータス</span>
                    @elseif($book->status === 1)
                    <span class="badge badge-danger p-2">未読</span>
                    @elseif($book->status === 2)
                    <span class="badge badge-primary p-2">読書中</span>
                    @elseif($book->status === 3)
                    <span class="badge badge-warning p-2">積読</span>
                    @elseif($book->status === 4)
                    <span class="badge badge-success p-2">読了</span>
                    @endif
                </div>
                <p>[タイトル]</p>
                <p>{{ $book->title }}</p>
                <p>[著者]</p>
                <p>{{ $book->author }}</p>
                <p>[詳細]</p>
                <p>{{ $book->description }}</p>
                <p>[isbn]</p>
                <p>{{ $book->isbn }}</p>
                <p>[タグ]</p>
                {{-- @foreach ($bookTags as $btag) --}}
                    {{-- <span class="border p-1 m-2 text-muted">{{ $btag->name }} , </span> --}}
                {{-- @endforeach --}}
                <p>[評価]</p>
                <div class="text-left my-2">
                    @if($book->rank === 0)
                    <span class="star-empty">★★★★★</span>
                    @elseif($book->rank === 1)
                    <span class="star">★</span><span class="star-empty">★★★★</span>
                    @elseif($book->rank === 2)
                    <span class="star">★★</span><span class="star-empty">★★★</span>
                    @elseif($book->rank === 3)
                    <span class="star">★★★</span><span class="star-empty">★★</span>
                    @elseif($book->rank === 4)
                    <span class="star">★★★★</span><span class="star-empty">★</span>
                    @elseif($book->rank === 5)
                    <span class="star">★★★★★</span>
                    @endif
                </div>

                <p>[読了日]</p>
                <p>{{ $book->read_at }}</p>
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
