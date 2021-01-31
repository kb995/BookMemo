@extends('layouts/layout')

@section('title', 'マイページ')

@section('styles')

@endsection

@section('content')
<section class="container user mt-3">
    <div class="user-mask row">
        <h1 class="col-12 text-white h3 my-4 pl-5">{{ $user->name }}の本棚</h1>
        <div class="col-md-3">
            <div class="user-thumbnail">
                @if($user->thumbnail === null)
                    <img class="img-thumbnail" src="https://book-quote.s3-ap-northeast-1.amazonaws.com/layouts/default_user.jpg" alt="ユーザーサムネイル">
                @else
                    <img class="img-thumbnail" src="{{ $user->thumbnail }}" alt="ユーザーサムネイル">
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

<section class="book container">

    <form method="POST" action="{{ route('books.index') }}" class="text-right mt-5 pr-2">
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

    <div class="book-list row mt-5">
        @foreach( $books as $book)
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="book-item mb-5 shadow">
                <div class="book-item-cover">
                    @if($book->img_url === null)
                    <a href="{{ route('books.show', ['book' => $book]) }}">
                        <img class="shadow fadein" src="https://book-quote.s3-ap-northeast-1.amazonaws.com/layouts/book-default.jpg">
                    </a>
                    @else
                    <a href="{{ route('books.show', ['book' => $book]) }}">
                        <img class="shadow fadein"  src="{{ $book->img_url }}">
                    </a>
                    @endif
                </div>
                <div class="book-item-body">
                    <p class="title mt-3">{{ $book->title }}</p>
                    <p class="author text-muted mb-0 mt-2">{{ $book->author }}</p>
                    <p class="text-muted text-right mx-3"><i class="far fa-comment pr-1"></i>{{ $book->memo_count }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="text-center">
        {{ $books->appends(request()->input())->links() }}
    </div>
</section>

@endsection
