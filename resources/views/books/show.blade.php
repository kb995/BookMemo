@extends('layouts/layout')

@section('title', '書籍詳細')

@section('styles')
    {{-- @include('libs.flatpickr.styles') --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"> --}}
@endsection

@section('content')
<section>
    <div class="book-show-info shadow">

        <div class="book-cover-wrapper">
            @if($book->cover)
            <div class="book-cover">
                <img src="{{ asset('/storage/common/'. $book->cover) }}">
            </div>
            @else
            <div class="book-cover">
                <i class="book-default fas fa-book"></i>
            </div>
            @endif
        </div>

        <div class="book-info-wrapper">
            <h1 class="h2">{{ $book->title }}</h1>
            <dl>
                <dt>著者 : </dt>
                <dd>{{ $book->author }}</dd>
                <dt>カテゴリー : </dt>
                <dd>{{ $book->category }}</dd>
                <dt>ISBN : </dt>
                <dd>{{ $book->isbn }}</dd>
                <dt>出版日 : </dt>
                <dd></dd>
                <dt>詳細 : </dt>
                <dd>{{ $book->description }}</dd>
                <dt>評価 : </dt>
                @if($book->rank === 0)
                <dd class="star-empty">★★★★★</dd>
                @elseif($book->rank === 1)
                <dd class="star">★</dd><dd class="star-empty">★★★★</dd>
                @elseif($book->rank === 2)
                <dd class="star">★★</dd><dd class="star-empty">★★★</dd>
                @elseif($book->rank === 3)
                <dd class="star">★★★</dd><dd class="star-empty">★★</dd>
                @elseif($book->rank === 4)
                <dd class="star">★★★★</dd><dd class="star-empty">★</dd>
                @elseif($book->rank === 5)
                <dd class="star">★★★★★</dd>
                @endif
                <dt>ステータス : </dt>
                @if($book->status === 0)
                <dd class="badge badge-secondary p-2">ステータス</dd>
                @elseif($book->status === 1)
                <dd class="badge badge-danger p-2">未読</dd>
                @elseif($book->status === 2)
                <dd class="badge badge-primary p-2">読書中</dd>
                @elseif($book->status === 3)
                <dd class="badge badge-warning p-2">積読</dd>
                @elseif($book->status === 4)
                <dd class="badge badge-success p-2">読了</dd>
                @endif
            </dl>
            <a class="btn btn-info text-white" href="{{ route('books.edit', ['book' => $book]) }}"><i class="far fa-edit text-white pr-1"></i>編集</a>
            <form class="deleteform" action="{{ route('books.destroy', ['book' => $book]) }}" method="post" id="delete_book_{{ $book->id }}">
                @csrf
                @method('DELETE')
                <a class="btn btn-danger inline" data-id="{{ $book->id }}" onclick="deleteBook(this);">
                    <i class="fas fa-trash-alt pr-1"></i>
                    削除
                </a>
            </form>
        </div>
    </div>
</section>

<section class="memo-form-wrapper">
    @include('layouts.errors')
    {{--  メモ登録フォーム  --}}
    <form method="POST" action="{{ route('books.memos.store', ['book' => $book]) }}" class="memo-form">
        @csrf
        <div class="form-group">
            <label for="memo"></label>
            <textarea class="form-control" id="memo" name="memo" value="{{ old('memo') }}" rows="4" cols="40" placeholder="読書メモ"></textarea>
            <input class="form-control" type="text" name="tag" value="{{ old('tag') }}" placeholder="メモタグ">
            <div class="text-center">
                <input type="submit" class="btn btn-lg btn-success my-2 w-100">
            </div>
        </div>
    </form>

</section>

{{--  メモ検索フォーム  --}}
<section class="memo-search">
    <form method="POST" action="{{ route('books.show', ['book' => $book]) }}" class="inline memo-search-form">
        @csrf
        @if (Session::has('search'))
        <div class="h4 text-left mt-3">
        「 {{ Session::get('search') }} 」を表示中 ( {{ $memos->firstItem() }} - {{ $memos->lastItem() }} /  {{ $memos->total() }} 件中 )
        </div>
        @endif
        <div class="form-group">
            <input type="text" name="keyword" value="{{ old('keyword') }}" placeholder="キーワード検索">
            <input type="submit" class="btn btn-outline-info py-1" value="検索">
        </div>
    </form>

</section>

{{--  メモ一覧  --}}
<section class="memos mt-5">
    {{--  メモタブ  --}}
    <ul class="nav nav-tabs justify-content-end" role="tablist">
        <li class="nav-item">
            <a class="nav-link {{ Session::has('tag') ? '': 'active' }}" href="" role="tab" aria-controls="all" aria-selected="true">All</a>
        </li>

        @if($tags)
            @foreach ($tags as $tag)
            <li class="nav-item">
                <a href="javascript:tagform{{$tag->tag}}.submit()" class="nav-link {{ Session::get('tag') == $tag->tag ? 'active': '' }}" role="tab" aria-selected="true">{{ $tag->tag }}</a>
            </li>
            <form action="{{ route('books.show', ['book' => $book]) }}" method="POST" name="tagform{{$tag->tag}}">
                @csrf
                <input type="hidden" name="tag" value="{{ $tag->tag }}">
            </form>
            @endforeach
        @endif
    </ul>
      {{--  メモコンテンツ  --}}
      <div class="tab-content">
        <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
            @foreach ($memos as $memo)
            <article class="card mb-4 memo-item shadow">
                <div class="card-body">
                    {{ $memo->memo }}
                </div>
                <div class="card-footer memo-info text-right">
                    <span>
                        {{ $memo->tag }}
                    </span>
                    <a class="inline" href="{{ route('books.memos.edit', ['book' => $book, 'memo' => $memo]) }}"><i class="far fa-edit"></i>編集</a>
                    <form class="delete-form" action="{{ route('books.memos.destroy', ['book' => $book, 'memo' => $memo]) }}" method="post" id="delete_memo_{{ $memo->id }}">
                        @csrf
                        @method('DELETE')
                        <a class="inline text-danger" data-id="{{ $memo->id }}" onclick="deleteMemo(this);">
                            <i class="fas fa-trash-alt"></i>
                            削除
                        </a>
                    </form>
                    <span>id:{{ $memo->id }}</span>
                    {{ $memo->created_at }}
                </div>
            </article>
            @endforeach
        </div>

    <div class="text-center">
        {{ $memos->appends(request()->input())->links() }}
    </div>

</section>

<div class="text-center py-1 mt-5">
    Copyright © 2020 ***. All Rights Reserved.
</div>

@endsection
