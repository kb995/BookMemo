@extends('layouts/layout')

@section('title', '書籍編集')

@section('styles')
    {{-- @include('libs.flatpickr.styles') --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"> --}}
@endsection

@section('content')

{{ Breadcrumbs::render('book.edit', $book) }}

<section class="conteiner"
style="background-image: url('../../../storage/app/public/common/desk.jpg');
background-size: cover;
padding: 100px 0;
"
>

<div class="row justify-content-center my-5">
    <div class="col-md-8">
        <div class="card" style="opacity: 0.95;">
            <div class="card-header h5">
                書籍編集
            </div>

            <div class="card-body p-5">
                @include('layouts.errors')

                <form method="POST" action="{{ route('books.update', ['book' => $book]) }}" class="card mx-auto p-5" enctype="multipart/form-data">
                    @method('PATCH')
                    @csrf
                    <table class="table table-bordered">
                        <tbody>
                            <tr>

                                <th class="text-center"><label for="cover">表紙</label></th>
                                <td>
                                    @if($book->cover)
                                    <img class="p-1 mb-3" id="preview" src="../../../storage/app/public/books/{{$book->cover}}" style="max-width:200px;">
                                    @elseif($book->cover == null)
                                    <img class="p-1 mb-3" id="preview" src="../../../storage/app/public/books/default_book.jpg" style="max-width:200px;">
                                    @endif
                                    <input type="file" class="form-control p-1 mb-3" id="cover" name="cover" accept="image/*" value="{{ $book->cover ?? old('cover') }}" onchange="previewImage(this);">
                                </td>
                            </tr>
                            <tr>
                                <th class="text-center"><label for="title">書籍タイトル</label></th>
                                <td><input type="text" class="form-control" id="title" name="title" value="{{ $book->title ?? old('title') }}"></td>
                            </tr>
                            <tr>
                                <th class="text-center"><label for="author">著者</label></th>
                                <td><input type="text" class="form-control" id="author" name="author" value="{{ $book->author ?? old('author') }}"></td>
                            </tr>
                            <tr>
                                <th class="text-center"><label for="isbn">ISBN</label></th>
                                <td><input type="text" class="form-control" id="isbn" name="isbn" value="{{ $book->isbn ?? old('isbn') }}"></td>
                            </tr>
                            <tr>
                                <th class="text-center"><label for="page">ページ数</label></th>
                                <td><input type="text" class="form-control" id="page" name="page" value="{{ $book->page ?? old('page') }}"></td>
                            </tr>
                            <tr>
                                <th class="text-center"><label for="publisher">出版社</label></th>
                                <td><input type="text" class="form-control" id="publisher" name="publisher" value="{{ $book->publisher ?? old('publisher') }}"></td>
                            </tr>
                            <tr>
                                <th class="text-center"><label for="published_at">発売年月</label></th>
                                <td><input type="date" name="published_at" id="published_at" class="form-control" value="{{ $book->published_at ?? old('published_at') }}"></td>
                            </tr>
                            <tr>
                                <th class="text-center"><label for="description">詳細</label></th>
                                <td><input type="text" class="form-control" id="description" name="description" value="{{ $book->description ?? old('description') }}"></td>
                            </tr>
                            <tr>
                                <th class="text-center"><label for="category">カテゴリー</label></th>
                                <td><input type="text" class="form-control" id="category" name="category" value="{{ $book->category ?? old('category') }}"></td>
                            </tr>
                            <tr>
                                <th class="text-center"><label for="rank">評価</label></th>
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
                                <th class="text-center"><label for="status">ステータス</label></th>
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
                                <th class="text-center"><label for="read_at">読了日</label></th>
                                <td><input type="date" name="read_at" id="read_at" class="form-control" value="{{ $book->read_at ?? old('read_at') }}"></td>
                            </tr>
                        </tbody>
                    </table>
                    <p class="text-right">
                        <a class="text-danger inline" data-id="{{ $book->id }}" onclick="deleteBook(this);">
                            <i class="fas fa-trash-alt pr-1"></i>削除
                        </a>
                    </p>

                    <input type="submit" class="btn btn-lg btn-outline-success my-4 w-100" value="編集する">
                </form>

                <form class="deleteform" action="{{ route('books.destroy', ['book' => $book]) }}" method="post" id="delete_book_{{ $book->id }}">
                    @csrf
                    @method('DELETE')
                </form>

            </div>
        </div>
    </div>
</div>

</section>
@endsection
