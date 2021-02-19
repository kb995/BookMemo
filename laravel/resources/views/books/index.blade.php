@extends('layouts/layout')

@section('title', 'マイページ')

@section('styles')

@section('content')
<section class="user-mask p-2 shadow">
    <div class="container">
        <div class="row mx-auto bg-white p-3 p-md-2">
            <div class="col-md-3 col-6 text-center p-0">
                <div class="user-thumbnail mx-auto">
                    @if($user->thumbnail === null)
                        <img class="img-thumbnail" src="https://book-quote.s3-ap-northeast-1.amazonaws.com/layouts/default_user.jpg" alt="ユーザーサムネイル">
                    @else
                        <img class="img-thumbnail" src="{{ $user->thumbnail }}" alt="ユーザーサムネイル">
                    @endif
                </div>
                <p class="my-2"><a class="user-edit-link" href="{{ route('user.edit', ['user' => Auth::user()]) }}">{{ $user->name }}さん</a></p>
            </div>

            <div class="col-md-4 col-6 p-0">
                <div>
                    <h1 class="h4 bold">{{ $user->name }}の本棚</h1>
                </div>
                <div class="row user-book-count">
                    <dl class="text-center d-inline-block card ml-4 p-1 mr-1">
                        <a href="{{ route('books.index') }}">
                            <dt>全て</dt>
                            <dd>{{ $book_counts['books_all'] }} <small class="text-muted">冊</small></dd>
                        </a>
                    </dl>

                    <dl class="text-center d-inline-block card p-1 mr-1">
                        <a href="{{ route('books.index') }}?status=2">
                            <dt>読書</dt>
                            <dd>{{ $book_counts['books_reading'] }} <small class="text-muted">冊</small></dd>
                        </a>
                    </dl>

                    <dl class="text-center d-inline-block card p-1 mr-1">
                        <a href="{{ route('books.index') }}?status=3">
                            <dt>積読</dt>
                            <dd>{{ $book_counts['books_pile'] }} <small class="text-muted">冊</small></dd>
                        </a>
                    </dl>

                    <dl class="text-center d-inline-block card p-1 mr-1">
                        <a href="{{ route('books.index') }}?status=4">
                            <dt>読了</dt>
                            <dd>{{ $book_counts['books_read'] }} <small class="text-muted">冊</small></dd>
                        </a>
                    </dl>
                </div>
            </div>

            <div class="col-md-5 col-12 d-flex align-items-center text-center">
                <div class="mx-auto m-3 mx-md-0">
                    <a href="{{ route('books.search') }}" class="btn btn-lg p-3 m-1 btn-outline-primary d-inline-block"><i class="fas fa-search pr-2"></i></i>検索して本を登録</a>
                    <a href="{{ route('books.create') }}" class="btn btn-lg p-3 m-1 btn-outline-success d-inline-block"><i class="fas fa-pen pr-2"></i>入力して本を登録</a>
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

    @if($books->isEmpty())
        <h2 class="mx-auto font-italic text-secondary">本を登録してみましょう</h2>
    @endif

    <div class="book-list row mt-5">
        @foreach( $books as $book )
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="book-item mb-5 shadow">
                <div class="book-item-cover fadein">
                    @if($book->img_url === null)
                    <div class="img-trim">
                        <a href="{{ route('books.show', ['book' => $book]) }}">
                            <img class="shadow" src="https://book-quote.s3-ap-northeast-1.amazonaws.com/layouts/default_cover.png">
                        </a>
                    </div>
                    @else
                    <div>
                        <a href="{{ route('books.show', ['book' => $book]) }}">
                            <img class="shadow" src="{{ $book->img_url }}">
                        </a>
                    </div>
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
