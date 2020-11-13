@extends('layouts/layout')

@section('title', '書籍詳細')

@section('styles')
    {{-- @include('libs.flatpickr.styles') --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"> --}}
@endsection

@section('content')
{{-- <section class="conteiner">
    <h1 class="text-center my-5">書籍詳細</h1>
    <table class="table-bordered w-50 mx-auto text-center">
        <th>ID</th>
        <th>タイトル</th>
        <th>著者</th>
        <th>ISBN</th>
        <th>詳細</th>
        <th>状態</th>
        <th>評価</th>
        <th>読了日</th>
        <tr>
            <td>{{ $book->id }}</a></td>
            <td>{{ $book->title }}</td>
            <td>{{ $book->author }}</td>
            <td>{{ $book->isbn }}</td>
            <td>{{ $book->description }}</td>
            <td>{{ $book->status }}</td>
            <td>{{ $book->rank }}</td>
            <td>{{ $book->read_at }}</td>
            <td><a class="btn btn-info" href="{{ route('books.edit', ['book' => $book]) }}">編集</td>
            <td>
                <form action="{{ route('books.destroy', ['book' => $book]) }}" method="post" id="delete_book_{{ $book->id }}">
                    @csrf
                    @method('DELETE')
                    <a class="btn btn-danger" data-id="{{ $book->id }}" onclick="deleteBook(this);">
                        <i class="fas fa-trash-alt pr-1"></i>
                        削除
                    </a>
                </form>
            </td>
        </tr>
    </table>

    <div class="text-center my-3">
        <img src="{{ asset('/storage/'. $book->cover) }}" style="height:150px; width: 100px;">
    </div>


    @include('layouts.errors')

    @include('memos.create')

    @include('memos.index')

</section> --}}

<section>
    <div class="row">
        <div class="side col-md-3 col-sm-12">
            @if($book->cover)
            {{-- <a href="{{ route('books.show', ['book' => $book]) }}"> --}}
                <div class="book-cover">
                    <img src="{{ asset('/storage/'. $book->cover) }}">
                </div>
            {{-- </a> --}}
            @else
            {{-- <a href="{{ route('books.show', ['book' => $book]) }}"> --}}
                <div class="book-cover">
                    <i class="book-default fas fa-book"></i>
                </div>
            {{-- </a> --}}
            @endif
            <p>[タイトル] {{ $book->title }} </p>
            <p>[著者]{{ $book->author }}</p>
            <p>[詳細]{{ $book->description }}</p>
            <p>[isbn]{{ $book->isbn }}</p>
            <p>[状態]{{ $book->status }}</p>
            <p>[タグ]</p>
            <p>[評価]<span class="star">★★★★★</span></p>
            <p>[読了日]{{ $book->read_at }}</p>
        </div>

        <div class="memos col-md-9 col-sm-12">
        </div>
    </div>
</section>
@endsection
