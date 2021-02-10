@extends('layouts/layout')

@section('title', '書籍詳細')

@section('styles')

@section('content')

{{-- パンくずリスト --}}
{{ Breadcrumbs::render('book.show', $book) }}

<section class="book-info pt-3 shadow">

    {{--  書籍メニュー  --}}
    <div class="row w-75 mx-auto">
        <div class="offset-md-1"></div>
        <div class="col-md-2">
            <div class="book-info-cover text-center shadow">
                @if($book->img_url === null)
                    <img src="https://book-quote.s3-ap-northeast-1.amazonaws.com/layouts/default_cover.png">
                @else
                    <img src="{{ $book->img_url }}">
                @endif
            </div>

            <div class="text-center mt-2">
                <a href="{{ route('books.edit', ['book' => $book]) }}">編集</a>
            </div>
        </div>

        <div class="col-md-7">
            <h1 class="title my-4 my-md-0 pt-md-1">{{ $book->title }}</h1>
            <p class="author mb-0 text-center text-md-left py-2 text-muted">{{ $book->author }}</p>

            <div class="text-center text-md-left mt-1">
                @if($book->status === 0)
                <p class="badge badge-secondary p-1 m-0">ステータス</p>
                @elseif($book->status === 1)
                <p class="badge badge-danger p-1 m-0">未読</p>
                @elseif($book->status === 2)
                <p class="badge badge-primary p-1 m-0">読書中</p>
                @elseif($book->status === 3)
                <p class="badge badge-warning p-1 m-0">積読</p>
                @elseif($book->status === 4)
                <p class="badge badge-success p-1 m-0">読了</p>
                @endif
            </div>
        </div>
        <div class="offset-md-1"></div>
    </div>

    {{--  書籍詳細  --}}
    <div class="collapse p-3 book-detail w-75 mx-auto" id="input">
        <div class="book-cover-full">
            @if($book->img_url === null)
                <img src="https://book-quote.s3-ap-northeast-1.amazonaws.com/layouts/default_cover.png">
            @else
                <img src="{{ $book->img_url }}">
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

    <button class="btn btn-link btn-detail"
    data-toggle="collapse"
    data-target="#input"
    aria-expand="false"
    aria-controls="input-1">
    詳細検索<i class="fas fa-chevron-circle-down pl-2"></i>
    </button>

</section>


{{-- メモフォーム --}}
<div class="row m-0">
    <div class="col-md-5">
        <section class="memo-form pt-md-5 mt-md-5">
            @include('layouts.errors')
            <form method="POST" action="{{ route('books.memos.store', ['book' => $book]) }}">
                @csrf
                <div class="form-group">
                    <label for="memo"></label>
                    <textarea class="form-control p-3" wrap="soft" id="memo" name="memo" rows="10" cols="10" placeholder="読書メモを入力" onkeyup="strLimit(1000);">{{ old('memo') }}</textarea>
                    <div class="text-right mt-1">
                        <span class="post_count"><span id="label">1000</span>/1000</span>
                    </div>
                    <label for="memo"></label>
                    <select class="form-control" name="folder" id="memo">
                        <option class="" value="" default>フォルダーを選択</option>
                        @foreach ($folders as $folder)
                            <option value="{{ $folder->name }}">{{ $folder->name }}</option>
                        @endforeach
                    </select>
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
                    <input class="memo-search-form-input" type="text" name="keyword" value="{{ old('keyword') }}" placeholder="メモ内を検索">
                    <button class="memo-search-form-button" type="submit" class="btn btn-outline-info py-1">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>
        </div>

        <section class="memos">
            {{--  メモタブ  --}}
            <ul class="nav nav-tabs justify-content-end">
                <li class="nav-item">
                    <a class="nav-link {{ Session::has('current_folder')  ? '': 'active' }}" href="" role="tab" aria-controls="all" aria-selected="true">All</a>
                </li>
                @if($folders)
                    @foreach ($folders as $folder)
                    <li class="nav-item">
                        <a href="javascript:tagform{{$folder->name}}.submit()" class="nav-link {{ Session::get('current_folder') == $folder->name ? 'active': '' }}">{{ $folder->name }}</a>
                    </li>
                    <form action="{{ route('books.show', ['book' => $book]) }}" method="POST" name="tagform{{$folder->name}}">
                        @csrf
                        <input type="hidden" name="current_folder" value="{{ $folder->name }}">
                    </form>
                    @endforeach
                @endif
                <li class="nav-item">
                    <a href="{{ route('books.folders.create', ['book' => $book]) }}" class="btn"><i class="fas fa-folder-plus"></i></a>
                </li>
            </ul>

            <form class="text-right" method="POST" action="{{ route('books.folders.destroy', ['book' => $book]) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn"><i class="fas fa-folder-minus"></i></button>
            </form>

            {{--  フォルダー追加 モーダル  --}}
            {{--  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">フォルダー作成</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('books.folders.store') }}" method="POST" id="folder_create">
                                @csrf
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">フォルダー名</label>
                                    <input type="text" name="name" class="form-control" id="recipient-name">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                                    <button type="submit" class="btn btn-primary" form="folder_create">作成</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>  --}}

        {{--  メモ一覧  --}}
        <div class="tab-content">
            @if($memos->isEmpty())
            <h3 class="mx-auto font-italic text-secondary">メモを登録してみましょう</h3>
            @endif

            {{--  <div id="summary">
                <p style="white-space: pre-wrap;" class="collapse" id="collapseSummary">
                    {{ $memo->memo }}
                </p>
                <a class="collapsed" data-toggle="collapse" href="#collapseSummary" aria-expanded="false" aria-controls="collapseSummary"></a>
            </div>  --}}

            <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
                @foreach ($memos as $memo)
                <article class="card mb-5 memo-item shadow">
                    <div class="card-body pb-1" id="summary">
                        <p style="white-space: pre-wrap;" class="collapse" id="collapseSummary{{$memo->id}}">{{ $memo->memo }}</p>
                        <a class="collapsed text-muted" data-toggle="collapse" href="#collapseSummary{{$memo->id}}" aria-expanded="false" aria-controls="collapseSummary"></a>
                    </div>
                    <div class="card-footer p-2">
                        <div class="d-flex justify-content-between">
                            <div>
                                <span class="badge badge-secondary ml-2" style="line-height: 1.8;">{{ $memo->folder }}</span>
                            </div>
                            <div>
                                <span class="inline-block pr-3">{{ $memo->created_at->format('Y/m/d H:i') }}</span>
                                <a class="inline-block pr-3" href="{{ route('books.memos.edit', ['book' => $book, 'memo' => $memo]) }}"><i class="far fa-edit"></i>編集</a>
                                <a class="text-danger inline-block pr-3" data-id="{{ $memo->id }}" onclick="deleteMemo(this);">
                                    <i class="fas fa-trash-alt"></i>削除
                                </a>
                                <form class="delete-form inline-block" action="{{ route('books.memos.destroy', ['book' => $book, 'memo' => $memo]) }}" method="post" id="delete_memo_{{ $memo->id }}">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </div>
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
