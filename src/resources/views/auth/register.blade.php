@extends('layouts.app')

@section('header')
@include('layouts.auth_header')
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/register.css') }}">
@endsection

@section('content')
<div class="register-form">
    <div class="register-form__inner">
        <form class="register-form__form" action="/register" method="POST">
            @csrf

            <h2 class="register-form__heading">会員登録</h2>

            <div class="register-form__group">
                <label class="register-form__label" for="name">ユーザー名</label>
                <input class="register-form__input" type="text" name="name">
                <p class="register-form__error-message">
                    @error('name')
                    {{ $message }}
                    @enderror
                </p>
            </div>

            <div class="register-form__group">
                <label class="register-form__label" for="email">メールアドレス</label>
                <input class="register-form__input" type="email" name="email">
                <p class="register-form__error-message">
                    @error('email')
                    {{ $message }}
                    @enderror
                </p>
            </div>

            <div class="register-form__group">
                <label class="register-form__label" for="password">パスワード</label>
                <input class="register-form__input" type="password" name="password">
                <p class="register-form__error-message">
                    @error('password')
                    {{ $message }}
                    @enderror
                </p>
            </div>

            <div class="register-form__group">
                <label class="register-form__label" for="password_confirmation">確認用パスワード</label>
                <input class="register-form__input" type="password" name="password_confirmation">
            </div>

            <input
                class="register-form__register-btn btn"
                type="submit"
                value="登録する">

            <div class="register-form__link-wrapper">
                <a href="/login" class="register-form__login-link">
                    ログインはこちら
                </a>
            </div>
        </form>
    </div>
</div>
@endsection