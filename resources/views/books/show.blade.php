@extends('layouts/layout')

@section('title', '書籍詳細')

@section('styles')
    {{-- @include('libs.flatpickr.styles') --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"> --}}
@endsection

@section('content')
<section class="conteiner">
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
                <form action="{{ route('books.destroy', ['book' => $book]) }}" method="post" id="delete_{{ $book->id }}">
                    @csrf
                    @method('DELETE')
                    <a class="btn btn-danger" data-id="{{ $book->id }}" onclick="deletePost(this);">
                        <i class="fas fa-trash-alt pr-1"></i>
                        削除
                    </a>
                </form>
            </td>
        </tr>
    </table>

    @include('layouts.errors')

    @include('memos.create')

    @include('memos.index')

</section>
@endsection

@section('scripts')
<script>
    function deletePost(e) {
        'use strict';
        if (confirm('本当に削除しますか?')) {
            document.getElementById('delete_' + e.dataset.id).submit();
        }
    }
</script>
@endsection
