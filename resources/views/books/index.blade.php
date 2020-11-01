@extends('layouts/layout')

@section('title', 'マイページ')

@section('styles')
    {{-- @include('libs.flatpickr.styles') --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"> --}}
@endsection

@section('content')
<section class="conteiner">
    <h1 class="text-center h3 my-5">書籍一覧</h1>

    <div class="card w-50 mx-auto text-center">
        {{ $user->id }} : {{ $user->name }}
    </div>
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
</section>
@endsection
