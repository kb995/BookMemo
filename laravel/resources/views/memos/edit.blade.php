@extends('layouts/layout')

@section('title', 'メモ編集')

@section('styles')
    {{-- @include('libs.flatpickr.styles') --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"> --}}
@endsection

@section('content')
    @section('breadcrumbs')
    {{ Breadcrumbs::render('memo.edit', $book, $memo) }}
    @endsection

<section class="conteiner">
    <h1 class="text-center w-50 my-5 mx-auto h3">メモ編集</h1>

    @include('layouts.errors')

    <form method="POST" action="" class="card mx-auto w-50 p-5">
    @method('PATCH')
    @csrf
        <div class="form-group">
            <textarea type="text" wrap="hard" class="form-control" id="memo" name="memo" rows="10"  onkeyup="strLimit(1000);">{{ $memo->memo ?? old('memo') }}</textarea>
            <div class="text-right my-2">
                <span class="post_count"><span id="label">1000</span>/1000</span>
            </div>
            <select class="form-control mb-3" name="folder" id="memo">
                <option class="" value="" default>フォルダーを選択</option>
                @foreach ($folders as $folder)
                    <option value="{{ $folder->name }}">{{ $folder->name }}</option>
                @endforeach
            </select>
            <input type="submit" class="btn btn-outline-success w-100 my-4" value="編集する">
        </div>
    </form>
</section>

@endsection
