@extends('layouts/layout')

@section('title', '書籍詳細')

@section('styles')
    {{-- @include('libs.flatpickr.styles') --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"> --}}
@endsection

@section('content')

<section class="book-info py-4">
    <div class="row w-75 mx-auto">
        <div class="col-md-3">
            <div class="book-info-cover text-center">
                @if($book->cover === null)
                    <img src="https://book-quote.s3-ap-northeast-1.amazonaws.com/layouts/book-default.jpg">
                @else
                    <img src="{{ $book->cover }}">
                @endif
            </div>

            <div class="text-center mt-3">
                @if($book->status === 0)
                <p class="badge badge-secondary p-2 m-0">ステータス</p>
                @elseif($book->status === 1)
                <p class="badge badge-danger p-2 m-0">未読</p>
                @elseif($book->status === 2)
                <p class="badge badge-primary p-2 m-0">読書中</p>
                @elseif($book->status === 3)
                <p class="badge badge-warning p-2 m-0">積読</p>
                @elseif($book->status === 4)
                <p class="badge badge-success p-2 m-0">読了</p>
                @endif
            </div>

            <div class="text-center mt-2">
                <a class="text-white" href="{{ route('books.edit', ['book' => $book]) }}">編集</a>
            </div>
        </div>
        <div class="col-md-9">
            <h1 class="title my-4 my-md-0">{{ $book->title }}</h1>

            <p class="author mb-0 text-center text-md-left py-2">{{ $book->author }}</p>

            <button class="btn btn-link btn-detail pt-5"
            data-toggle="collapse"
            data-target="#input"
            aria-expand="false"
            aria-controls="input-1">
            詳細検索<i class="fas fa-chevron-circle-down pl-2"></i>
            </button>
        </div>
    </div>

    <div class="collapse p-3 book-detail w-75 mx-auto" id="input">
        <div class="book-cover-full">
            @if($book->cover === null)
                <img src="https://book-quote.s3-ap-northeast-1.amazonaws.com/layouts/book-default.jpg">
            @else
                <img src="{{ $book->cover }}">
            @endif
        </div>

        <div class="w-75 mx-auto">
            <dl class="row">
                <dt class="col-3">タイトル</dt>
                <dd class="col-9 w-100">{{ $book->title }}</dd>
            </dl>
            <dl class="row">
                <dt class="col-3">著者</dt>
                <dd class="col-9">{{ $book->author }}</dd>
            </dl>
            <dl class="row">
                <dt class="col-3">概要</dt>
                <dd class="col-9 text-justify">{{ $book->description }}</dd>
            </dl>
            <dl class="row">
                <dt class="col-3">ISBN</dt>
                <dd class="col-9">{{ $book->isbn }}</dd>
            </dl>
            <dl class="row">
                <dt class="col-3">出版社</dt>
                <dd class="col-9">{{ $book->publisher }}</dd>
            </dl>
            <dl class="row">
                <dt class="col-3">出版日</dt>
                <dd class="col-9">{{ $book->published_at }}</dd>
            </dl>
            <dl class="row">
                <dt class="col-3">ページ</dt>
                <dd class="col-9">{{ $book->page }}</dd>
            </dl>
            <dl class="row">
                <dt class="col-3">カテゴリー</dt>
                <dd class="col-9">{{ $book->category }}</dd>
            </dl>
            <dl class="row">
                <dt class="col-3">評価</dt>
                <dd class="col-9">
                    @if($book->rank === 0)
                    <span class="star-empty">☆☆☆☆☆</span>
                    @elseif($book->rank === 1)
                    <span class="star">★</span><span class="star-empty">☆☆☆☆</span>
                    @elseif($book->rank === 2)
                    <span class="star">★★</span><span class="star-empty">☆☆☆</span>
                    @elseif($book->rank === 3)
                    <span class="star">★★★</span><span class="star-empty">☆☆</span>
                    @elseif($book->rank === 4)
                    <dd class="star">★★★★</dd><dd class="star-empty">☆</dd>
                    @elseif($book->rank === 5)
                    <span class="star">★★★★★</span>
                    @endif
                </dd>
            </dl>
        </div>
    </div>
</section>

{{-- パンくずリスト --}}
{{ Breadcrumbs::render('book.show', $book) }}

{{-- メモフォーム --}}
<div class="row m-0">
<div class="col-md-5">
    @include('layouts.errors')
    <section class="memo-form pt-md-5 mt-md-5">
        <form method="POST" action="{{ route('books.memos.store', ['book' => $book]) }}">
            @csrf
            <div class="form-group">
                <label for="memo"></label>
                <textarea class="form-control" id="memo" name="memo" rows="4" cols="40" placeholder="読書メモを入力" onkeyup="strLimit(1000);">{{ old('memo') }}</textarea>
                <div class="text-right mt-1">
                    <span class="post_count">残り文字数 <span id="label">1000</span>/1000</span>
                </div>
                <label for="tag"></label>
                <input class="form-control" type="text" name="tag" value="{{ old('tag') }}" placeholder="タグを入力">
                <div class="text-center">
                    <input value="登録" type="submit" class="btn btn-success mt-5 w-100">
                </div>
            </div>
        </form>
    </section>
</div>{{-- col-3 --}}

<div class="col-md-7">
{{-- メモ検索フォーム  --}}
    <div class="memo-search mb-5">
        <form method="POST" action="{{ route('books.show', ['book' => $book]) }}" class="inline memo-search-form">
            @csrf
            @if (Session::has('search'))
            <div class="h4 text-left mt-3">
            「 {{ Session::get('search') }} 」を表示中 ( {{ $memos->firstItem() }} - {{ $memos->lastItem() }} /  {{ $memos->total() }} 件中 )
            </div>
            @endif
            <div class="form-group pt-3">
                <input type="text" name="keyword" value="{{ old('keyword') }}" placeholder="メモ内を検索">
                <input type="submit" class="btn btn-outline-info py-1" value="検索">
            </div>
        </form>
    </div>

    <section class="memos">
        {{--  メモタブ  --}}
        <ul class="nav nav-tabs justify-content-end mb-5" role="tablist">
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

    {{--  メモ一覧  --}}
    <div class="tab-content">
        <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
            @foreach ($memos as $memo)
            <article class="card mb-4 memo-item shadow">

                <div class="card-header text-right p-2">
                    <span class="inline-block pr-2 text-muted">#{{ $memo->tag }}</span>
                    <a class="inline-block pr-1" href="{{ route('books.memos.edit', ['book' => $book, 'memo' => $memo]) }}"><i class="far fa-edit"></i>編集</a>
                    <a class="text-danger inline-block pr-1" data-id="{{ $memo->id }}" onclick="deleteMemo(this);">
                        <i class="fas fa-trash-alt"></i>削除
                    </a>
                    <span class="inline-block pr-1">{{ $memo->created_at->format('Y/m/d H:i') }}</span>
                    <form class="delete-form inline-block" action="{{ route('books.memos.destroy', ['book' => $book, 'memo' => $memo]) }}" method="post" id="delete_memo_{{ $memo->id }}">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
                <div class="card-body">
                    {{ $memo->memo }}
                </div>

            </article>
            @endforeach
        </div>

    </section>

</div>{{-- col-7 --}}

</div>{{-- row --}}

<div class="text-center">
    {{ $memos->appends(request()->input())->links() }}
</div>

@endsection
