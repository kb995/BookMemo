@extends('layouts.app')

@section('content')
{{-- <img src="../storage/app/public/common/desk.jpg" alt=""> --}}
<section
style="background-image: url('https://book-quote.s3-ap-northeast-1.amazonaws.com/layouts/desk.jpg');
background-size: cover;
padding: 100px 0;
">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="opacity: 0.95;">
                <div class="card-header h5">
                    ログイン
                </div>
                <div class="card-body p-5">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="kb995@email.com" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" value="11111111">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check text-right text-muted mt-2">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>

                                    <div class="text-right">
                                        @if (Route::has('password.request'))
                                            <a class="btn btn-link px-0" href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-0 text-center">
                            <button type="submit" class="btn btn-lg btn-outline-primary w-75 mx-auto my-3">
                                {{ __('Login') }}
                            </button>

                            <p class="font-weight-bold py-4  text-center">ソーシャルログイン</p>

                        </div>
                    </form>

                    <div class="text-center">
                        <a href="{{ route('login.{provider}', ['provider' => 'google']) }}">
                            <button class="btn btn-lg btn-danger w-75 mx-auto my-3">
                                <i class="fab fa-google text-white mr-1"></i>Googleでログイン
                            </button>
                        </a>
                    </div>

                    {{-- <p class="font-weight-bold py-4 text-center">アカウントをお持ちでない方はこちら</p>

                    <div class="text-center">
                        <a class="register-link" href="{{ route('register') }}">
                            <button class="register-button btn btn-lg w-75 mx-auto text-white">
                                新規会員登録
                            </button>
                        </a>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</div>

</section>

@endsection
