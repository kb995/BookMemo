@extends('layouts/layout')

@section('title', '書籍編集')

@section('styles')
    {{-- @include('libs.flatpickr.styles') --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"> --}}
@endsection

@section('content')

    @section('breadcrumbs')
    {{ Breadcrumbs::render('book.edit', $book) }}
    @endsection

<section class="conteiner">
    <h1 class="text-left w-50 my-5 mx-auto h2">書籍編集</h1>

    @include('layouts.errors')

    <form method="POST" action="{{ route('books.update', ['book' => $book]) }}" class="card mx-auto w-50 p-5" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th><label for="cover">表紙</label></th>
                    <td><input type="file" class="form-control p-1 mb-3" id="cover" name="cover" accept="image/png,image/jpeg" value="{{ old('cover')}}"></td>
                </tr>
                <tr>
                    <th><label for="title">書籍タイトル</label></th>
                    <td><input type="text" class="form-control" id="title" name="title" value="{{ $book->title ?? old('title') }}"></td>
                </tr>
                <tr>
                    <th><label for="author">著者</label></th>
                    <td><input type="text" class="form-control" id="author" name="author" value="{{ $book->author ?? old('author') }}"></td>
                </tr>
                <tr>
                    <th><label for="isbn">ISBN</label></th>
                    <td><input type="text" class="form-control" id="isbn" name="isbn" value="{{ $book->isbn ?? old('isbn') }}"></td>
                </tr>
                <tr>
                    <th><label for="description">詳細</label></th>
                    <td><input type="text" class="form-control" id="description" name="description" value="{{ $book->description ?? old('description') }}"></td>
                </tr>
                <tr>
                    <th><label for="category">カテゴリー</label></th>
                    <td><input type="text" class="form-control" id="category" name="category" value="{{ $book->category ?? old('category') }}"></td>
                </tr>
                <tr>
                    <th><label for="rank">評価</label></th>
                    <td>
                        <select name="rank" class="form-control" id="rank" value="{{ old('rank') }}">
                            <option value="0" {{ $book->rank == 0 ? 'selected' : '' }}>-</option>
                            <option value="1" {{ $book->rank == 1 ? 'selected' : '' }}>★☆☆☆☆</option>
                            <option value="2" {{ $book->rank == 2 ? 'selected' : '' }}>★★☆☆☆</option>
                            <option value="3" {{ $book->rank == 3 ? 'selected' : '' }}>★★★☆☆</option>
                            <option value="4" {{ $book->rank == 4 ? 'selected' : '' }}>★★★★☆</option>
                            <option value="5" {{ $book->rank == 5 ? 'selected' : '' }}>★★★★★</option>
                        </select>
                            </td>
                </tr>
                <tr>
                    <th><label for="status">ステータス</label></th>
                    <td>
                        <select name="status" class="form-control" id="status" value="{{ old('status') }}">
                            <option value="0" {{ $book->status == 0 ? 'selected' : '' }}>-</option>
                            <option value="1" {{ $book->status == 1 ? 'selected' : '' }}>未読</option>
                            <option value="2" {{ $book->status == 2 ? 'selected' : '' }}>読書中</option>
                            <option value="3" {{ $book->status == 3 ? 'selected' : '' }}>積読</option>
                            <option value="4" {{ $book->status == 4 ? 'selected' : '' }}>読了</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th><label for="read_at">読了日</label></th>
                    <td><input type="date" name="read_at" id="read_at" class="form-control" value="{{ $book->read_at ?? old('read_at') }}"></td>
                </tr>
            </tbody>
        </table>

        <input type="submit" class="btn btn-outline-success my-4" value="編集する">
    </form>
</section>
@endsection
