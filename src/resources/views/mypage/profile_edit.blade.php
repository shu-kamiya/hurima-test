@extends('layouts.app')

@section('header')
@include('layouts.app_header')
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage/profile_edit.css') }}">
@endsection

@section('content')
<div class="profile-edit-page">

    <h1 class="profile-title">プロフィール設定</h1>

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="profile-image-area">
            <img
                src="{{ $profile->profile_image_url ? asset('storage/' . $profile->profile_image_url) : asset('images/default-profile.png') }}"
                class="profile-image-preview">
            <label for="profile-image" class="button--select-image">画像を登録する</label>
            <input type="file" name="image" id="profile-image" hidden>
        </div>

        <div class="form-group name-group">
            <label>ユーザー名</label>
            <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}">
            @error('name') <p class="error-message">{{ $message }}</p> @enderror
        </div>

        <div class="form-group post-code-group">
            <label>郵便番号</label>
            <input type="text" name="post_code" value="{{ old('post_code', $profile->post_code) }}">
        </div>

        <div class="form-group address-group">
            <label>住所</label>
            <input type="text" name="address" value="{{ old('address', $profile->address) }}">
        </div>

        <div class="form-group building-group">
            <label>建物名</label>
            <input type="text" name="building" value="{{ old('building', $profile->building) }}">
        </div>

        <button class="button--update-large">更新する</button>
    </form>
</div>


@endsection