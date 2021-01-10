@extends('layouts/layout')

@section('title', 'マイページ')

@section('styles')
    {{-- @include('libs.flatpickr.styles') --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"> --}}
@endsection

@section('content')
<section class="container user mt-3">
    <div class="user-mask row">
        <h1 class="col-12 text-white h3 my-4 pl-5">{{ $user->name }}の本棚</h1>
        <div class="col-md-3">
            <div class="user-thumbnail">
                @if ($user->thumbnail)
                <img class="img-thumbnail" src="../storage/app/public/user/{{$user->thumbnail}}" alt="ユーザーアイコン">
                @else
                <img class="img-thumbnail" src="../storage/app/common/default_img/default_user.jpg" alt="ユーザーアイコン">
                @endif
                <p class="mt-2"><a class="user-edit-link" href="{{ route('user.edit', ['user' => Auth::user()]) }}">{{ $user->name }}さん</a></p>
            </div>
        </div>

        <div class="col-md-3 p-2">
            <div class="user-book-count row d-flex justify-content-center">
                <dl class="col-5 col-md-4 text-center mb-2">
                    <dt>登録本</dt>
                    <dd>{{ $book_counts['books_all'] }} <small class="text-muted">冊</small></dd>
                </dl>
                <dl class="col-5 col-md-4 text-center mb-2">
                    <dt>読了本</dt>
                    <dd>{{ $book_counts['books_read'] }} <small class="text-muted">冊</small></dd>
                </dl>

                <dl class="col-5 col-md-4 text-center mb-2">
                    <dt>積読本</dt>
                    <dd>{{ $book_counts['books_pile'] }} <small class="text-muted">冊</small></dd>
                </dl>
                <dl class="col-5 col-md-4 text-center mb-2">
                    <dt>***本</dt>
                    <dd>{{ $book_counts['books_pile'] }} <small class="text-muted">冊</small></dd>
                </dl>
           </div>
        </div>

        <div class="col-md-6">
            <div class="d-flex align-items-center">
                <div class="link-info mx-auto">
                    <a href="{{ route('books.search') }}" class="btn btn-lg p-3 mr-2 btn-outline-primary d-inline-block col-12 col-md-8 mb-3"><i class="fas fa-search pr-2"></i></i>検索して本を登録</a>
                    <a href="{{ route('books.create') }}" class="btn btn-lg p-3 btn-outline-success d-inline-block col-12 col-md-8 mb-3"><i class="fas fa-pen pr-2"></i>入力して本を登録</a>
                </div>
            </div>

        </div>
    </div>
</section>

<section class="book">

    <form method="POST" action="{{ route('books.index') }}" class="text-right mt-4 mr-5 pr-2">
        @csrf
        @if (Session::has('search'))
        <p class="h4 text-center">
        「 {{ Session::get('search') }} 」を表示中 ( {{ $books->firstItem() }} - {{ $books->lastItem() }} /  {{ $books->total() }} 件中 )
        </p>
        @endif

        <div class="form-group shelf-search-container">
            <input class="shelf-serach-input" type="text" name="keyword" value="{{ old('keyword') }}" placeholder="本棚からさがす">
            <button type="submit" class="shelf-search-button">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </form>

    <div class="book-list">
        @foreach( $books as $book)
        <div class="book-item shadow">
            <div class="book-item-cover">
                <a href="{{ route('books.show', ['book' => $book]) }}">
                    <img class="shadow" src="../storage/app/public/books/{{$book->cover}}">
                </a>
            </div>
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
