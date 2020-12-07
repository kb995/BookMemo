@extends('layouts/layout')

@section('title', 'マイページ')

@section('styles')
    {{-- @include('libs.flatpickr.styles') --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"> --}}
@endsection

@section('content')
<section class="info-wrapper">
    <div class="user-info">
        <div class="user-icon">
            <img src="{{ asset('/storage/common/default_user.jpeg') }}" alt="ユーザーアイコン">
        </div>
        <h1 class="user-name h3">{{ $user->name }}の本棚 </h1>
        <p class="user-edit"><a href="">{{ $user->name }}さん</a><a class="btn btn-outline-primary btn-sm ml-2" href="">編集</a></p>
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
</section>

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

        <form method="POST" action="" class="collapse p-5" id="input">
            <div class="form-group ml-3">
                <div class="row">
                    <div class="col-6">
                        <label class="detail-search-label" for="keyword">カテゴリーから探す</label>
                        <select class="detail-search-input" name="category" id="category">
                            <option value="" default>カテゴリー選択</option>
                            @foreach ($category_list as $category)
                            {{--  <option value="{{ $category->category }}" {{ old('category') === $category->category ? 'selected' : '' }}>  --}}
                            <option value="{{ $category->category }}">
                                {{ $category->category }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-6">
                        <label class="detail-search-label" for="">著者名から探す</label>
                        <input class="detail-search-input" name="" id="" placeholder="著者名">
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-6">
                        <label class="detail-search-label" for="">ISBNから探す</label>
                        <input class="detail-search-input" name="" id="" placeholder="13桁の書籍ID">
                    </div>
                    <div class="col-6">
                        <label class="detail-search-label" for="">読書状態から探す</label>
                        <input class="detail-search-input" name="" id="" placeholder="未読 or 既読 or 積読">
                    </div>
                </div>

                <input type="submit" class="detail-search-btn" value="検索">
                <input type="submit" class="detail-search-btn-clear" value="検索をクリア">
            </div>
        </form>
    </div>
</section>

<section class="book-shelf">
    <div class="book-list">
        @foreach( $books as $book)
        <div class="book-item shadow">
            @if($book->cover)
            <div class="book-cover">
                <a href="{{ route('books.show', ['book' => $book]) }}">
                    <img src="{{ asset('/storage/common/'. $book->cover) }}">
                </a>
            </div>
            @elseif($book->cover == null)
            <div class="book-cover">
                <a href="{{ route('books.show', ['book' => $book]) }}">
                    <i class="book-default fas fa-book"></i>
                </a>
            </div>
            @endif

            <div class="book-item-info">
                <p class="book-title">{{ $book->title }}</p>
                <p class="text-muted mb-0">{{ $book->author }}</p>
                <p class="text-muted text-right mx-3"><i class="far fa-comment pr-1"></i>{{ $book->memo_count }}</p>
            </div>
        </div>
        @endforeach
    </div>

    <div class="text-center">
        {{ $books->appends(request()->input())->links() }}
    </div>
</section>


      {{--  <div class="text-center">
            @if (Session::has('search'))
            <div class="py-2 px-3 h3">
            「 {{ Session::get('search') }} 」を表示中 ( {{ $books->firstItem() }} - {{ $books->lastItem() }} /  {{ $books->total() }} 件中 )
            </div>
            @endif
    </div>

        <div class="text-center">
            <a href="{{ route('books.create') }}">書籍登録</a>
        </div>  --}}
@endsection
