@extends('layouts/layout')

@section('title', 'マイページ')

@section('styles')
    {{-- @include('libs.flatpickr.styles') --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"> --}}
@endsection

@section('content')
    <section class="header-prof">
        <div class="prof-card-wrapper">
            <div class="prof-card">
                <div class="user-icon">
                    <a href="">
                        <img class="user-icon" src="{{ asset('/storage/common/default_user.jpeg') }}" alt="ユーザーアイコン">
                    </a>
                </div>
                <div class="user-info">
                    <h1 class="h3">{{ $user->name }}の本棚</h1>
                    <a href="">{{ $user->name }}さん</a> | <a class="btn btn-outline-primary btn-sm ml-2" href="">編集</a>
                    <ul class="shelf-info">
                        <li class="shelf-info-list">
                            <dl>
                                <dt>登録数</dt>
                                <dd>100</dd>
                            </dl>
                        </li>
                        <li class="shelf-info-list">
                            <dl>
                                <dt>読了済</dt>
                                <dd>80</dd>
                            </dl>
                        <li class="shelf-info-list">
                            <dl>
                                <dt>積読</dt>
                                <dd>10</dd>
                            </dl>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="text-center">
            <a href="{{route('books.create')}}">書籍登録</a>
        </div>
    </section>

    <section class="book-shelf">
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
                <p class="star">★★★★★</p>
            </div>
            @endforeach

            <div class="text-center">
                {{ $books->links() }}
            </div>

        </div>
    </section>
@endsection
