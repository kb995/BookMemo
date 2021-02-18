@extends('layouts.app')

@section('content')
<section
style="background-image: url('https://book-quote.s3-ap-northeast-1.amazonaws.com/layouts/desk.jpg');
background-size: cover;
padding-bottom: 500px;
">
>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 py-5">
            <div class="card"　style="opacity: 0.95;">
                <div class="card-header h5">
                    パスワード再設定メール送信
                </div>
                <div class="card-body p-5">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-10 offset-md-2">
                                <input id="email" type="email" class="w-75 form-control-lg border border-secondary @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="メールアドレス">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-10 offset-md-2">
                                <button type="submit" class="btn btn-lg btn-outline-primary w-75 my-3">
                                    メール送信
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
@endsection
