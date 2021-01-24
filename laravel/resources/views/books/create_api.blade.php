@extends('layouts/layout')

@section('title', '書籍登録(API)')

@section('styles')
    {{-- @include('libs.flatpickr.styles') --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"> --}}
@endsection

@section('content')

<section class="conteiner py-2 py-md-5"
style="background-image: url('https://book-quote.s3-ap-northeast-1.amazonaws.com/layouts/desk.jpg');
background-size: cover;
padding: 100px 0;
"
>
    <div class="row justify-content-center my-5">
        <div class="col-md-8 col-11">
            <div class="card" style="opacity: 0.95;">
                <div class="card-header h5">
                    書籍登録(API)
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('books.api.store') }}" class="mx-auto" enctype="multipart/form-data">
                        @include('layouts.errors')
                        @csrf
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th class="text-center"><label for="cover">表紙</label></th>
                                        <td>
                                            <img src="{{ $img }}" style="max-width:200px;" class="m-3">
                                            <input type="hidden" class="form-control p-1 mb-3" name="img_url" value="{{ $img }}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-center"><label for="title">書籍タイトル<span class="badge badge-danger ml-2 p-1">必須</span></label></th>
                                        <td><input type="text" class="form-control" id="title" name="title" value="{{ $result['title'] }}" onchange="previewImage(this);"></td>
                                    </tr>
                                    <tr>
                                        <th class="text-center"><label for="author">著者</label></th>
                                        <td><input type="text" class="form-control" id="author" name="author" value="{{ $result['authors'][0] }}"></td>
                                    </tr>
                                    <tr>
                                        <th class="text-center"><label for="isbn">ISBN</label></th>
                                        <td><input type="number" class="form-control" id="isbn" name="isbn" value="{{ $result['industryIdentifiers'][0]['identifier'] }}"></td>
                                    </tr>
                                    <tr>
                                        <th class="text-center"><label for="page">ページ数</label></th>
                                        <td><input type="text" class="form-control" id="page" name="page" value="{{ $result['pageCount'] }}"></td>
                                    </tr>
                                    <tr>
                                        <th class="text-center"><label for="publisher">出版社</label></th>
                                        <td><input type="text" class="form-control" id="publisher" name="publisher" value="{{ $result['publisher'] }}"></td>
                                    </tr>
                                    <tr>
                                        <th class="text-center"><label for="published_at">発売年月</label></th>
                                        <td><input type="date" name="published_at" id="published_at" class="form-control" value="{{ $result['publishedDate'] }}"></td>
                                    </tr>

                                    <tr>
                                        <th class="text-center"><label for="description">詳細</label></th>
                                        <td>
                                            <textarea class="form-control" name="description" id="description" cols="30" rows="10">{{ $result['description'] }}</textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-center"><label for="category">カテゴリー</label></th>
                                        <td><input type="text" class="form-control" id="category" name="category" value=""></td>
                                    </tr>
                                    <tr>
                                        <th class="text-center"><label for="status">ステータス</label></th>
                                        <td>
                                            <select name="status" class="form-control" id="status" value="{{ old('status') }}">
                                                <option value="0" {{ old('status') === '0' ? 'selected' : '' }}>-</option>
                                                <option value="1" {{ old('status') === '1' ? 'selected' : '' }}>未読</option>
                                                <option value="2" {{ old('status') === '2' ? 'selected' : '' }}>読書中</option>
                                                <option value="3" {{ old('status') === '3' ? 'selected' : '' }}>積読</option>
                                                <option value="4" {{ old('status') === '4' ? 'selected' : '' }}>読了</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-center"><label for="rank">評価</label></th>
                                        <td>
                                            <select name="rank" class="form-control" id="rank" value="{{ old('rank') }}">
                                                <option value="0" {{ old('rank') === '0' ? 'selected' : '' }}>-</option>
                                                <option value="1" {{ old('rank') === '1' ? 'selected' : '' }}>★☆☆☆☆</option>
                                                <option value="2" {{ old('rank') === '2' ? 'selected' : '' }}>★★☆☆☆</option>
                                                <option value="3" {{ old('rank') === '3' ? 'selected' : '' }}>★★★☆☆</option>
                                                <option value="4" {{ old('rank') === '4' ? 'selected' : '' }}>★★★★☆</option>
                                                <option value="5" {{ old('rank') === '5' ? 'selected' : '' }}>★★★★★</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-center"><label for="read_at">読了日</label></th>
                                        <td><input type="date" name="read_at" id="read_at" class="form-control" value=""></td>
                                    </tr>
                                </tbody>
                            </table>

                        <input type="submit" class="btn btn-lg btn-outline-success my-4 w-100" value="登録">

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
