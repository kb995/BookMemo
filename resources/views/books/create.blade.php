@extends('layouts/layout')

@section('title', '書籍登録')

@section('styles')
    {{-- @include('libs.flatpickr.styles') --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"> --}}
@endsection

@section('content')
<section class="conteiner">
    <h1 class="text-center my-5">書籍登録</h1>

    @include('layouts.errors')

    <form method="POST" action="{{ route('books.store') }}" class="card mx-auto w-50 p-5" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="cover">表紙</label>
            <input type="file" class="form-control p-1 mb-3" id="cover" name="cover" accept="image/png,image/jpeg" value="{{ old('cover')}}">

            <label for="title">書籍タイトル</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">

            <label for="author">著者</label>
            <input type="text" class="form-control" id="author" name="author" value="{{ old('author') }}">

            <label for="isbn">ISBN</label>
            <input type="text" class="form-control" id="isbn" name="isbn" value="{{ old('isbn') }}">

            <label for="description">詳細</label>
            <input type="text" class="form-control" id="description" name="description" value="{{ old('description') }}">

            <label for="status">状態</label>
            <select name="status" class="form-control" id="status" value="{{ old('status') }}">
                <option value="0" {{ old('rank') === '0' ? 'selected' : '' }}>-</option>
                <option value="1" {{ old('rank') === '1' ? 'selected' : '' }}>未読</option>
                <option value="2" {{ old('rank') === '2' ? 'selected' : '' }}>読書中</option>
                <option value="3" {{ old('rank') === '3' ? 'selected' : '' }}>積読</option>
                <option value="4" {{ old('rank') === '4' ? 'selected' : '' }}>読了</option>
            </select>

            <div class="my-2">
                <label for="rank">評価</label>
                <select name="rank" class="form-control" id="rank" value="{{ old('rank') }}">
                    <option value="0" {{ old('rank') === '0' ? 'selected' : '' }}>☆☆☆☆☆</option>
                    <option value="1" {{ old('rank') === '1' ? 'selected' : '' }}>★☆☆☆☆</option>
                    <option value="2" {{ old('rank') === '2' ? 'selected' : '' }}>★★☆☆☆</option>
                    <option value="3" {{ old('rank') === '3' ? 'selected' : '' }}>★★★☆☆</option>
                    <option value="4" {{ old('rank') === '4' ? 'selected' : '' }}>★★★★☆</option>
                    <option value="5" {{ old('rank') === '5' ? 'selected' : '' }}>★★★★★</option>
                </select>
            </div>

            <label for="read_at">読了日</label>
            <div>
                <input type="date" name="read_at" id="read_at" class="form-control" value="{{ old('read_at') }}">
            </div>

            <input type="submit" class="btn btn-primary my-4">
        </div>

    </form>
</section>
@endsection
