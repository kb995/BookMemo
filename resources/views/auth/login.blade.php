@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="text-center my-5">ログイン</h1>

            <p class="text-center mb-3">ブクメモに登録している方は、下記からログインしてください。</br>
                まだ登録していない方は<a href="{{ route('register') }}">コチラ</a>から登録してください。</p>

            <div class="card">
                <div class="card-body p-5">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="sasaki.taro@example.net" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
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
                                <div class="form-check text-right text-muted">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-0 text-center">
                            <button type="submit" class="btn btn-lg btn-outline-primary w-75 mx-auto my-3">
                                {{ __('Login') }}
                            </button>

                            <div class="col-md-8 offset-md-4 text-right">

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link mr-5" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>

                        </div>
                    </form>

                    <p class="font-weight-bold py-4 text-center">アカウントをお持ちでない方はこちら</p>

                    <div class="text-center">
                        <button class="register-button btn btn-lg w-75 mx-auto">
                            <a class="register-link" href="{{ route('register') }}">
                                新規会員登録
                            </a>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="text-center py-1 mt-5">
    Copyright © 2020 ***. All Rights Reserved.
</div>
@endsection
