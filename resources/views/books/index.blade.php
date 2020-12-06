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

        {{--  <div class="text-center">
            @if (Session::has('search'))
            <div class="py-2 px-3 h3">
            「 {{ Session::get('search') }} 」を表示中 ( {{ $books->firstItem() }} - {{ $books->lastItem() }} /  {{ $books->total() }} 件中 )
            </div>
            @endif
        </div>

        <div class="text-center">
            <a href="{{ route('books.create') }}">書籍登録</a>
        </div>

        <form method="POST" action="{{ route('books.index') }}" class="text-center my-3">
            @csrf
            <div class="form-group ml-3">

                <input type="text" name="keyword" value="{{ old('keyword') }}" placeholder="キーワードで検索">

                <select name="category" id="category">
                    <option value="" default>カテゴリー選択</option>
                    @foreach ($category_list as $category)
                    <option value="{{ $category->category }}" {{ old('category') === $category->category ? 'selected' : '' }}>
                        {{ $category->category }}
                    </option>
                    @endforeach
                </select>

                <input type="submit" class="btn btn-sm btn-primary" value="検索">
            </div>
        </form>  --}}

    {{--  <section class="book-shelf">
        <div class="book-list">
            @foreach( $books as $book)
            <div class="book-item">
                @if($book->cover)
                <a href="{{ route('books.show', ['book' => $book]) }}">
                    <div class="book-cover">
                        <img src="{{ asset('/storage/'. $book->cover) }}">
                    </div>
                </a>
                @else
                <a href="{{ route('books.show', ['book' => $book]) }}">
                    <div class="book-cover">
                        <i class="book-default fas fa-book"></i>
                    </div>
                </a>
                @endif
                <p class="book-title">{{ $book->title }}</p>
                <p class="text-muted">{{ $book->author }}</p>
                <p class="text-muted text-right m-2"><i class="fas fa-comment pr-1"></i>{{ $book->memo_count }}</p>
            </div>
            @endforeach


        </div>

        <div class="text-center">
            {{ $books->appends(request()->input())->links() }}
        </div>
    </section>  --}}
@endsection
