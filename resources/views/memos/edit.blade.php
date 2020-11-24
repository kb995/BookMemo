@extends('layouts/layout')

@section('title', 'メモ編集')

@section('styles')
    {{-- @include('libs.flatpickr.styles') --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"> --}}
@endsection

@section('content')
<section class="conteiner">
    <h1 class="text-center my-5">メモ編集</h1>

    @include('layouts.errors')

    <form method="POST" action="" class="card mx-auto w-50 p-5">
    @method('PATCH')
    @csrf
        <div class="form-group">
            <label for="memo">メモ</label>
            <textarea type="text" class="form-control" id="memo" name="memo">{{ $memo->memo ?? old('memo') }}</textarea>

            <memo-tags-input-component
            :initial-tags='@json($tagNames ?? [])'
            :autocomplete-items='@json($allTagNames ?? [])'
            >
            </memo-tags-input-component>

            <input type="submit" class="btn btn-primary my-4" value="編集">
        </div>

    </form>
    </section>
@endsection
