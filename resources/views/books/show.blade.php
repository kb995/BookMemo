@extends('layouts/layout')

@section('title', '書籍詳細')

@section('styles')
    {{-- @include('libs.flatpickr.styles') --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"> --}}
@endsection

@section('content')

<section>
    <div class="row">
        {{-- サイドバー --}}
        <div class="side col-md-3 col-sm-12">
            @if($book->cover)
                <div class="book-cover">
                    <img src="{{ asset('/storage/'. $book->cover) }}">
                </div>
            @else
                <div class="book-cover">
                    <i class="book-default fas fa-book"></i>
                </div>
            @endif

            <div class="book-edit">
                <a class="btn btn-info text-white" href="{{ route('books.edit', ['book' => $book]) }}"><i class="far fa-edit text-white pr-1"></i>編集</a>

                <form class="deleteform" action="{{ route('books.destroy', ['book' => $book]) }}" method="post" id="delete_book_{{ $book->id }}">
                    @csrf
                    @method('DELETE')
                    <a class="btn btn-danger" data-id="{{ $book->id }}" onclick="deleteBook(this);">
                        <i class="fas fa-trash-alt pr-1"></i>
                        削除
                    </a>
                </form>
            </div>

            {{-- 書籍情報 --}}
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

                <p>[カテゴリー]</p>
                <p>{{ $book->category }}</p>

                <p>[isbn]</p>
                <p>{{ $book->isbn }}</p>

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

                <p>[タグ]</p>
                <div>
                    @foreach($memoTags as $tag)
                        <span class="p-2 my-3">
                            <a class="text-muted bg-light" href="{{ route('books.show', ['book' => $book, 'tag' => $tag]) }}">
                                #{{ $tag->name }}
                            </a>
                        </span>,
                    @endforeach
                </div>
            </div>
        </div>{{-- サイドバー --}} test

        {{-- 書籍メモ一覧 --}}
        <section class="memos col-md-9 col-sm-12">

            @include('layouts.errors')

            @include('memos.create')

            <div class="card p-2 mb-3">
                {{-- メモ一覧 メニュー --}}
                @if (Session::has('search'))
                    <div class="py-2 px-3 h3">
                    「 {{ Session::get('search') }} 」を表示中 ( {{ $memos->firstItem() }} - {{ $memos->lastItem() }} /  {{ $memos->total() }} 件中 )
                    </div>
                @endif

                <div class="py-2 px-3">
                    <div class="d-flex">
                        <span class="pl-3">
                            <a href="{{ route('books.show', ['book' => $book]) }}">メモ一覧</a>
                        </span>

                        <span class="pl-3">
                            <a href="{{ route('books.index') }}">書籍一覧</a>
                        </span>

                        <span class="pl-3">お気に入り一覧</span>

                        {{-- メモキーワード検索 --}}
                        <form method="POST" action="{{ route('books.show', ['book' => $book]) }}" class="inline">
                            @csrf
                            <div class="form-group ml-3">
                                <input type="text" name="keyword" value="{{ old('keyword') }}" placeholder="キーワード検索">
                                <select name="tag">
                            <option value="" default>タグ検索</option>
                                    @foreach($memoTags as $tag)
                                    <option value="{{ $tag->name }}">{{$tag->name}}</option>
                                    @endforeach
                                </select>
                                <input type="submit" class="btn btn-sm btn-primary" value="検索">
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            @foreach ($memos as $memo)
            <div class="card mb-4">
                <div class="card-header">
                    {{ $memo->id }}
                </div>
                <div class="card-body">
                    {{ $memo->memo }}
                </div>

                <div class="card-footer memo-info">
                    <a class="inline" href="{{ route('books.memos.edit', ['book' => $book, 'memo' => $memo]) }}"><i class="far fa-edit"></i>編集</a>
                    <form class="delete-form" action="{{ route('books.memos.destroy', ['book' => $book, 'memo' => $memo]) }}" method="post" id="delete_memo_{{ $memo->id }}">
                        @csrf
                        @method('DELETE')
                        <a class="inline text-danger" data-id="{{ $memo->id }}" onclick="deleteMemo(this);">
                            <i class="fas fa-trash-alt"></i>
                            削除
                        </a>
                    </form>

                    {{ $memo->created_at }}

                    @foreach($memo->tags as $tag)
                        <a href=" {{ route('books.show', ['book' => $book, 'tag' => $tag]) }}" class="border p-1 mr-1 mt-1 text-muted">
                        {{ $tag->hashtag }}
                        </a>
                    @endforeach
                </div>
            </div>
            @endforeach

            <div class="text-center">
                {{ $memos->appends(request()->input())->links() }}
            </div>
        </section>

        </div>
    </div>
</section>
@endsection
