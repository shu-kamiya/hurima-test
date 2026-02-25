@extends('layouts.app')

@section('header')
    @include('layouts.auth_header')
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/login.css') }}">
@endsection

@section('content')
<div class="login-form">
    <h2 class="login-form__heading">ログイン</h2>
    <div class="login-form__inner">
        <form class="login-form__form" action="{{ route('login') }}" method="POST">
            @csrf
            <div class="login-form__group">
                <label class="login-form__label" for="email">メールアドレス</label>
                <input class="login-form__input" type="mail" name="email">
                <p class="login-form__error-message">
                    @error('email')
                    {{ $message}}
                    @enderror
                </p>
            </div>
            <div class="login-form__group">
                <label class="login-form__label" for="password">パスワード</label>
                <input class="login-form__input" type="password" name="password">
                <p class="login-form__error-message">
                    @error('password')
                    {{ $message}}
                    @enderror
                </p>
            </div>

            <input class="login-form__login-btn btn" type="submit" value="ログインする" name="register">
            <div class="login-form__link-wrapper">
                <a href="/register" class="login-form__register-link">会員登録はこちら</a>
            </div>
        </form>
    </div>
</div>
@endsection