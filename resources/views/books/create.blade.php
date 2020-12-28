@extends('layouts/layout')

@section('title', '書籍登録')

@section('styles')
    {{-- @include('libs.flatpickr.styles') --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"> --}}
@endsection

@section('content')

<section class="conteiner"
style="background-image: url('../../storage/app/public/common/desk.jpg');
background-size: cover;
padding: 100px 0;
"
>
    @include('layouts.errors')

    <div class="row justify-content-center my-5">
        <div class="col-md-8">
            <div class="card" style="opacity: 0.95;">

                <div class="card-header h5">
                    書籍登録
                </div>

                <div class="card-body p-5">
                    <form method="POST" action="{{ route('books.store') }}" class="mx-auto p-5" enctype="multipart/form-data">
                        @csrf
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th><label for="cover">表紙</label></th>
                                        <td>
                                            <img id="preview" src="" style="max-width:200px;" class="m-3">
                                            <input type="file" class="form-control p-1 mb-3" id="cover" name="cover" accept="image/*" value="{{ old('cover')}}" onchange="previewImage(this);">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th><label for="title">書籍タイトル</label></th>
                                        <td><input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" onchange="previewImage(this);"></td>
                                    </tr>
                                    <tr>
                                        <th><label for="author">著者</label></th>
                                        <td><input type="text" class="form-control" id="author" name="author" value="{{ old('author') }}"></td>
                                    </tr>
                                    <tr>
                                        <th><label for="isbn">ISBN</label></th>
                                        <td><input type="text" class="form-control" id="isbn" name="isbn" value="{{ old('isbn') }}"></td>
                                    </tr>
                                    <tr>
                                        <th><label for="description">詳細</label></th>
                                        <td><input type="text" class="form-control" id="description" name="description" value="{{ old('description') }}"></td>
                                    </tr>
                                    <tr>
                                        <th><label for="category">カテゴリー</label></th>
                                        <td><input type="text" class="form-control" id="category" name="category" value="{{ old('category') }}"></td>
                                    </tr>
                                    <tr>
                                        <th><label for="status">ステータス</label></th>
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
                                        <th><label for="rank">評価</label></th>
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
                                        <th><label for="read_at">読了日</label></th>
                                        <td><input type="date" name="read_at" id="read_at" class="form-control" value="{{ old('read_at') }}"></td>
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
