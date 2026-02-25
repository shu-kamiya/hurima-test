@extends('layouts.app')

@section('header')
@include('layouts.app_header')
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/sell/sell.css') }}">
@endsection

@section('content')
<div class="sell-scroll">
    <div class="sell-container">

        <h1 class="sell-title">商品の出品</h1>

        <form action="{{ route('sell.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <section class="form-section">
                <h2 class="section-title">商品画像</h2>

                <div class="image-upload-box">
                    <label for="item-image" class="button--select-image">
                        画像を登録する
                    </label>
                    <input type="file" name="image" id="item-image" accept="image/*" hidden>

                    @error('image')
                    <p class="error-message">{{ $message }}</p>
                    @enderror

                    <div id="image-preview" class="image-preview"></div>
                </div>
            </section>

            <section class="form-section">
                <h2 class="section-title">商品の詳細</h2>

                <div class="form-group category-group">
                    <label class="form-label">カテゴリ</label>

                    <div class="category-tags">
                        @foreach ($categories as $category)
                        <label>
                            <input
                                type="checkbox"
                                name="category_ids[]"
                                value="{{ $category->id }}"
                                {{ in_array($category->id, old('category_ids', [])) ? 'checked' : '' }}>
                            <span class="category-tag">{{ $category->name }}</span>
                        </label>
                        @endforeach
                    </div>

                    @error('category_ids')
                    <p class="error-message">{{ $message }}</p>
                    @enderror

                </div>

                <div class="form-group">
                    <label for="condition">商品の状態</label>
                    <select name="condition" id="condition">
                        <option value="">選択してください</option>
                        <option value="良好" {{ old('condition') === '良好' ? 'selected' : '' }}>良好</option>
                        <option value="目立った傷や汚れなし" {{ old('condition') === '目立った傷や汚れなし' ? 'selected' : '' }}>
                            目立った傷や汚れなし
                        </option>
                        <option value="やや傷や汚れあり" {{ old('condition') === 'やや傷や汚れあり' ? 'selected' : '' }}>
                            やや傷や汚れあり
                        </option>
                        <option value="状態が悪い" {{ old('condition') === '状態が悪い' ? 'selected' : '' }}>
                            状態が悪い
                        </option>
                    </select>

                    @error('condition')
                    <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>
            </section>

            <section class="form-section">
                <h2 class="section-title">商品名と説明</h2>

                <div class="form-group">
                    <label for="name" class="form-label">商品名</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}">

                    @error('name')
                    <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="brand" class="form-label">ブランド名</label>
                    <input type="text" name="brand" id="brand" value="{{ old('brand') }}">

                    @error('brand')
                    <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description" class="form-label">商品の説明</label>
                    <textarea name="description" id="description" rows="6">{{ old('description') }}</textarea>

                    @error('description')
                    <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group price-group">
                    <label for="price" class="form-label">販売価格</label>

                    <div class="price-input">
                        <span class="price-yen">¥</span>
                        <input type="number" name="price" id="price" value="{{ old('price') }}">
                    </div>

                    @error('price')
                    <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>
            </section>

            <button type="submit" class="button--submit-sell">
                出品する
            </button>

        </form>
    </div>
</div>
@endsection