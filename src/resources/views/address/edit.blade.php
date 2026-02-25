@extends('layouts.app')

@section('header')
@include('layouts.app_header')
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/address/edit.css') }}">
@endsection

@section('content')
<div class="address-edit-container">
    <h1>住所の変更</h1>

    <form action="{{ route('address.update', $item->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="post_code">郵便番号</label>
            <input type="text" name="post_code" id="post_code" value="{{ old('post_code', $profile->post_code) }}" required>
            @error('post_code')
            <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="address">住所</label>
            <input type="text" name="address" id="address" value="{{ old('address', $profile->address) }}" placeholder="都道府県、市区町村、番地" required>
            @error('address')
            <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="building">建物名</label>
            <input type="text" name="building" id="building" value="{{ old('building', $profile->building) }}">
            @error('building')
            <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="button--update">更新する</button>
    </form>
</div>
@endsection