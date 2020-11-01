@extends('layouts/layout')

@section('title', '書籍編集')

@section('styles')
    {{-- @include('libs.flatpickr.styles') --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"> --}}
@endsection

@section('content')
<section class="conteiner">
    <h1 class="text-center my-5">書籍編集</h1>

    @if ($errors->any())
    <div class="alert alert-danger w-50 mx-auto">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form method="POST" action="{{ route('books.update', ['book' => $book]) }}" class="card mx-auto w-50 p-5">
    @method('PATCH')
    @csrf
        <div class="form-group">
            <label for="title">書籍タイトル</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $book->title ?? old('title') }}">

            <label for="author">著者</label>
            <input type="text" class="form-control" id="author" name="author" value="{{ $book->author ?? old('author') }}">

            <label for="isbn">ISBN</label>
            <input type="text" class="form-control" id="isbn" name="isbn" value="{{ $book->isbn ?? old('isbn') }}">

            <label for="description">詳細</label>
            <input type="text" class="form-control" id="description" name="description" value="{{ $book->description ?? old('description') }}">

            <label for="status">状態</label>
            <select name="status" class="form-control" id="status" value="{{ $book->status ?? old('status') }}">
                <option value="0">未読</option>
                <option value="1">読了</option>
                <option value="2">積読</option>
            </select>

            <div class="my-2">
                <label for="rank">評価</label>
                <select name="rank" class="form-control" id="rank" value="{{ old('rank') }}">
                    <option value="0">☆</option>
                    <option value="1">☆☆</option>
                    <option value="2">☆☆☆</option>
                </select>
            </div>

            <label for="read_at">読了日</label>
            <div>
                <input type="date" name="read_at" id="read_at" class="form-control" value="{{ old('read_at') }}">
            </div>

            <label for="category">カテゴリー</label>
            <select class="form-control">
                <option value="カテゴリー">カテゴリー</option>
            </select>

            <input type="submit" class="btn btn-primary my-4">
        </div>

    </form>
    </section>
@endsection
