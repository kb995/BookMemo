@extends('layouts/layout')

@section('title', '書籍編集')

@section('styles')
    {{-- @include('libs.flatpickr.styles') --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"> --}}
@endsection

@section('content')
<section class="conteiner">
    <h1 class="text-center my-5">書籍編集</h1>

    @include('layouts.errors')

    <form method="POST" action="{{ route('books.update', ['book' => $book]) }}" class="card mx-auto w-50 p-5" enctype="multipart/form-data">
    @method('PATCH')
    @csrf
        <div class="form-group">
            <div class="text-center my-3">
                <img src="{{ asset('/storage/'. $book->cover) }}" style="height:150px; width: 100px;">
            </div>
            <label for="cover">表紙</label>
            <input type="file" class="form-control p-1 mb-3" id="cover" name="cover" accept="image/png,image/jpeg" value="{{ old('cover')}}">

            <label for="title">書籍タイトル</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $book->title ?? old('title') }}">

            <label for="author">著者</label>
            <input type="text" class="form-control" id="author" name="author" value="{{ $book->author ?? old('author') }}">

            <label for="isbn">ISBN</label>
            <input type="text" class="form-control" id="isbn" name="isbn" value="{{ $book->isbn ?? old('isbn') }}">

            <label for="description">詳細</label>
            <input type="text" class="form-control" id="description" name="description" value="{{ $book->description ?? old('description') }}">

            <label for="category">詳細</label>
            <input type="text" class="form-control" id="category" name="category" value="{{ $book->category ?? old('category') }}">

            <label for="status">状態</label>
            <select name="status" class="form-control" id="status" value="{{ old('status') }}">
                <option value="0" {{ $book->status === 0 ? 'selected' : '' }}>-</option>
                <option value="1" {{ $book->status === 1 ? 'selected' : '' }}>未読</option>
                <option value="2" {{ $book->status === 2 ? 'selected' : '' }}>読書中</option>
                <option value="3" {{ $book->status === 3 ? 'selected' : '' }}>積読</option>
                <option value="4" {{ $book->status === 4 ? 'selected' : '' }}>読了</option>
            </select>

            <div class="my-2">
                <label for="rank">評価</label>
                <select name="rank" class="form-control" id="rank" value="{{ old('rank') }}">
                    <option value="0" {{ $book->rank === 0 ? 'selected' : '' }}>☆☆☆☆☆</option>
                    <option value="1" {{ $book->rank === 1 ? 'selected' : '' }}>★☆☆☆☆</option>
                    <option value="2" {{ $book->rank === 2 ? 'selected' : '' }}>★★☆☆☆</option>
                    <option value="3" {{ $book->rank === 3 ? 'selected' : '' }}>★★★☆☆</option>
                    <option value="4" {{ $book->rank === 4 ? 'selected' : '' }}>★★★★☆</option>
                    <option value="5" {{ $book->rank === 5 ? 'selected' : '' }}>★★★★★</option>
                </select>
            </div>

            <label for="read_at">読了日</label>
            <div>
                <input type="date" name="read_at" id="read_at" class="form-control" value="{{ old('read_at') }}">
            </div>
            <input type="submit" class="btn btn-primary my-4" value="編集">
        </div>

    </form>
    </section>
@endsection
