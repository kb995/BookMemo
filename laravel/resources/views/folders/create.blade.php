@extends('layouts/layout')

@section('title', 'フォルダ作成')

@section('styles')
    {{-- @include('libs.flatpickr.styles') --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"> --}}
@endsection

@section('content')

<section class="container">
    <form method="POST" action="{{ route('folders.create') }}" class="d-flex align-items-center justify-content-center min-vh-100">
        @csrf
        <div class="form-group mx-4 text-center w-75">
            <h2 class="google-search-label mb-4" for="keyword">フォルダー作成</h2>
            <div class="row">
                <input class="google-search-input col-10" type="text" name="folder" value="{{ old('folder') }}" placeholder="フォルダー名を入力">
                <input type="submit" class="btn btn-lg btn-primary col-2" value="作成">
            </div>
        </div>
    </form>
</section>

@endsection
