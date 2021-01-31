@extends('layouts/layout')

@section('title', '書籍編集')

@section('styles')

@endsection

@section('content')

{{ Breadcrumbs::render('book.edit', $book) }}

<section class="conteiner p-3 py-sm-5"
style="background-image: url('https://book-quote.s3-ap-northeast-1.amazonaws.com/layouts/desk.jpg');
background-size: cover;
"
>

<div class="row justify-content-center my-5">
    <div class="col-md-9 col-sm-11">
        <div class="card" style="opacity: 0.95;">
            <div class="card-header h5">
                書籍編集
            </div>

            <div class="card-body p-5">

                <form method="POST" action="{{ route('books.update', ['book' => $book]) }}" class="card mx-auto p-5" enctype="multipart/form-data">
                    @method('PATCH')
                    @csrf
                    @include('layouts.errors')
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th class="text-center"><label for="img_url">表紙</label></th>
                                <td>
                                    @if($book->img_url === null)
                                        <img class="p-1 mb-3" id="preview" style="max-width:200px;" src="https://book-quote.s3-ap-northeast-1.amazonaws.com/layouts/book-default.jpg">
                                    @else
                                        <img class="p-1 mb-3" id="preview" style="max-width:200px;" src="{{ $book->img_url }}">
                                    @endif
                                    {{--  <input type="file" class="form-control p-1 mb-3" id="img_url" name="img_url" accept="image/*" value="{{ old('img_url')}}" onchange="previewImage(this);">  --}}

                                    <input type="file" class="form-control p-1 mb-3" id="img_url" name="img_url" accept="image/*" value="{{ $book->img_url }}" onchange="previewImage(this);">
                                </td>
                            </tr>
                            <tr>
                                <th class="text-center"><label for="title">書籍タイトル<span class="badge badge-danger ml-2 p-1">必須</span></label></th>
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
                                <td>
                                    <textarea class="form-control" name="description" id="description" cols="30" rows="10">{{ $book->description ?? old('description') }}</textarea>

                                </td>
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
                            <i class="fas fa-trash-alt pr-1"></i>削除 &gt;&gt;
                        </a>
                    </p>

                    <input type="submit" class="btn btn-lg btn-outline-success my-2 w-100" value="編集する">
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
