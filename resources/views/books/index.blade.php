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
    </section>

    <div class="text-center my-5">
        <a class="btn btn-outline-success" href="{{ route('books.create') }}">書籍登録</a>
    </div>
    <table class="table-bordered w-50 mx-auto text-center">
        <th>タイトル</th>
        <th>著者</th>
        <th>状態</th>
        <th>user_id</th>
        @foreach( $books as $book)
        <tr>
            <td><a href="{{ route('books.show', ['book' => $book] ) }}">{{ $book->title }}</a></td>
            <td>{{ $book->author }}</td>
            <td>{{ $book->status }}</td>
            <td>{{ $book->user_id }}</td>
        </tr>
        @endforeach
    </table>
@endsection
