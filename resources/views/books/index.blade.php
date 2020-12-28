@extends('layouts/layout')

@section('title', 'マイページ')

@section('styles')
    {{-- @include('libs.flatpickr.styles') --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"> --}}
@endsection

@section('content')

<section class="user">
    <div class="user-mask">
        <div class="row w-75 mx-auto py-2">
            {{-- サムネイル --}}
           <div class="col-2 user-thumbnail">
               <img class="img-thumbnail" src="../storage/app/public/common/default_user.jpeg" alt="ユーザーアイコン">
               <p class="mt-2"><a class="user-edit-link" href="{{ route('user.edit', ['user' => Auth::user()]) }}">{{ $user->name }}さん</a></p>
           </div>
           {{-- 本棚名 --}}
           <div class="col-3 text-center">
               <h1 class="h5 user-title ml-4 mb-3 row">{{ $user->name }}の本棚</h1>
               <div class="user-info row">
                    <dl>
                        <dt>登録本</dt>
                        <dd>{{ $book_counts['books_all'] }} <small class="text-muted">冊</small></dd>
                    </dl>
                    <dl>
                        <dt>読了本</dt>
                        <dd>{{ $book_counts['books_read'] }} <small class="text-muted">冊</small></dd>
                    </dl>
                    <dl>
                        <dt>積読本</dt>
                        <dd>{{ $book_counts['books_pile'] }} <small class="text-muted">冊</small></dd>
                    </dl>
               </div>
           </div>
           <div class="col-5 d-flex align-items-center">
            <div class="link-info">
                <a href="{{ route('books.search') }}" class="btn btn-lg p-3 mr-2 btn-outline-primary d-inline-block"><i class="fas fa-search pr-2"></i></i>検索して本を登録</a>
                <a href="{{ route('books.create') }}" class="btn btn-lg p-3 btn-outline-success d-inline-block"><i class="fas fa-pen pr-2"></i>入力して本を登録</a>
            </div>
           </div>
        </div>
    </div>
</section>


{{-- <section class="info-wrapper">
    <div class="user-info">
        <div class="row">
            @if($user->thumbnail)
                <div class="user-icon shadow">
                    <img src="../storage/app/public/user/{{ $user->thumbnail }}" alt="ユーザーアイコン">
                    <span class="user-edit"><a class="btn btn-outline-primary btn-sm ml-2 mt-3" href="{{ route('user.edit', ['user' => Auth::user()]) }}">編集</a></span>
                </div>
            @elseif($user->thumbnail == null)
                <div class="user-icon col-3">
                    <img src="../storage/app/public/common/default_user.jpeg" alt="ユーザーアイコン">
                    <span class="user-edit"><a class="btn btn-outline-primary btn-sm ml-2 mt-3" href="{{ route('user.edit', ['user' => Auth::user()]) }}">編集</a></span>
                </div>
            @endif

            <h1 class="user-name h4 col-9">{{ $user->name }}の本棚 </h1>
        </div>
    </div>

    <div class="book-info">
        <ul class="mb-0 p-0">
            <a href="">
                <li class="book-count shadow">
                    <dl>
                        <dt>登録本</dt>
                        <dd>
                            {{ $book_counts['books_all'] }} <span class="text-muted count-text">冊</span>
                        </dd>
                    </dl>
                </li>
            </a>

            <a href="">
                <li class="book-count shadow">
                    <dl>
                        <dt>読了本</dt>
                        <dd>
                            {{ $book_counts['books_read'] }} <span class="text-muted count-text">冊</span>
                        </dd>
                    </dl>
                </li>
            </a>

            <a href="">
                <li class="book-count shadow">
                    <dl>
                        <dt>積読本</dt>
                        <dd>
                            {{ $book_counts['books_pile'] }} <span class="text-muted count-text">冊</span>
                        </dd>
                    </dl>
                </li>
            </a>
        </ul>
    </div>

    <div class="link-info">
        <p><a href="{{ route('books.create') }}" class="btn px-5 py-2 btn-outline-success"><i class="fas fa-pen pr-2"></i>入力して本を登録</a></p>
        <p><a href="{{ route('books.search') }}" class="btn px-5 py-2 btn-outline-primary"><i class="fas fa-pen pr-2"></i>検索して本を登録</a></p>
    </div>
</section> --}}

<section class="shelf-serach">
    <form method="POST" action="{{ route('books.index') }}" class="text-center my-3">
        @csrf
        <div class="form-group ml-3">
            <label class="shelf-serach-label block" for="keyword">本棚から探す</label>
            <input class="shelf-serach-input" type="text" name="keyword" value="{{ old('keyword') }}" placeholder="キーワードで検索">
            <input type="submit" class="shelf-serach-btn" value="検索">
        </div>
    </form>

    {{--  詳細検索フォーム  --}}
    <div class="text-center detail-search">
        <button class="btn btn-link btn-detail"
        data-toggle="collapse"
        data-target="#input"
        aria-expand="false"
        aria-controls="input-1">
        詳細検索<i class="fas fa-chevron-circle-down pl-2"></i>
        </button>

        <form method="POST" action="{{ route('books.index') }}" class="collapse p-5" id="input">
            @csrf
            <div class="form-group ml-3">
                <div class="row">
                    <div class="col-6">
                        <label class="detail-search-label" for="category">カテゴリーから探す</label>
                        <select class="detail-search-input" name="category" id="category">
                            <option default>カテゴリー選択</option>
                            @foreach ($category_list as $category)
                            <option value="{{ $category->category }}">
                                {{ $category->category }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-6">
                        <label class="detail-search-label" for="author">著者名から探す</label>
                        <input class="detail-search-input" name="author" id="author" placeholder="著者名">
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-6">
                        <label class="detail-search-label" for="isbn">ISBNから探す</label>
                        <input class="detail-search-input" name="isbn" id="isbn" placeholder="13桁の書籍ID">
                    </div>
                    <div class="col-6">
                        <label class="detail-search-label" for="status">読書状態から探す</label>
                        <select name="status" class="detail-search-input" id="status" value="{{ old('status') }}">
                            <option value="0" {{ old('status') === '0' ? 'selected' : '' }}>-</option>
                            <option value="1" {{ old('status') === '1' ? 'selected' : '' }}>未読</option>
                            <option value="2" {{ old('status') === '2' ? 'selected' : '' }}>読書中</option>
                            <option value="3" {{ old('status') === '3' ? 'selected' : '' }}>積読</option>
                            <option value="4" {{ old('status') === '4' ? 'selected' : '' }}>読了</option>
                        </select>
                    </div>
                </div>
                <input type="submit" class="detail-search-btn" value="検索">
                <input type="submit" class="detail-search-btn-clear" value="検索をクリア">
            </div>
        </form>
    </div>
</section>

@if (Session::has('search'))
<div class="h4 text-center mt-3">
「 {{ Session::get('search') }} 」を表示中 ( {{ $books->firstItem() }} - {{ $books->lastItem() }} /  {{ $books->total() }} 件中 )
</div>
@endif

<section class="book">
    <div class="book-list">
        @foreach( $books as $book)
        <div class="book-item shadow">
            @if($book->cover)
            <div class="book-item-cover">
                <a href="{{ route('books.show', ['book' => $book]) }}">
                    <img src="{{ asset('/storage/common/'. $book->cover) }}">
                </a>
            </div>
            @elseif($book->cover == null)
            <div class="book-item-cover">
                <a href="{{ route('books.show', ['book' => $book]) }}">
                    <div>
                        <img src="../storage/app/public/common/book.jpg" alt="">
                    </div>
                </a>
            </div>
            @endif

            <div class="book-item-body">
                <p class="title">{{ $book->title }}</p>
                <p class="author text-muted mb-0">{{ $book->author }}</p>
                <p class="text-muted text-right mx-3"><i class="far fa-comment pr-1"></i>{{ $book->memo_count }}</p>
            </div>
        </div>
        @endforeach
    </div>

    <div class="text-center">
        {{ $books->appends(request()->input())->links() }}
    </div>
</section>

@endsection
