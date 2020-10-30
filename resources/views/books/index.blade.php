@extends('layouts/layout')

@section('title', 'マイページ')

@section('styles')
    {{-- @include('libs.flatpickr.styles') --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"> --}}
@endsection

@section('content')
<section class="conteiner">
<h1 class="text-center">mypage</h1>
<div class="text-center">
    <a href="{{ route('books.create') }}">書籍登録</a>
</div>
<div class="text-center h3 my-3">書籍一覧</div>
    <table class="table-bordered w-50 mx-auto text-center">
        <th>ID</th>
        <th>タイトル</th>
        <th>著者</th>
        <th>ISBN</th>
        <th>詳細</th>
        <th>状態</th>
        <th>評価</th>
        <th>読了日</th>
        @foreach( $books as $book)
        <tr>
            <td><a href="{{ route('books.edit', $book) }}">{{ $book->id }}</a></td>
            <td>{{ $book->title }}</td>
            <td>{{ $book->author }}</td>
            <td>{{ $book->isbn }}</td>
            <td>{{ $book->description }}</td>
            <td>{{ $book->status }}</td>
            <td>{{ $book->rank }}</td>
            <td>{{ $book->read_at }}</td>
        </tr>
        @endforeach
    </table>
</section>
@endsection
