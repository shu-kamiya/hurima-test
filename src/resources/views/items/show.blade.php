@extends('layouts.app')

@section('header')
@include('layouts.app_header')
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/items/show.css') }}">
@endsection

@section('content')
<div class="item-detail-container">
    <div class="item-detail__image-area">
        <div class="item-image-placeholder">
            <img
                src="{{ asset('storage/' . $item->image_url) }}"
                alt="{{ $item->name }}"
                class="item-image">
        </div>
    </div>


    <div class="item-detail__info-area">
        <h1 class="item-detail__name">{{ $item->name }}</h1>
        <p class="item-detail__brand">ブランド名</p>
        <p class="item-detail__price">¥{{ number_format($item->price) }} (税込)</p>

        <div class="item-detail__icons">
            {{-- いいね --}}
            <div class="icon-group">
                @auth
                @if ($isLiked)
                <form action="{{ route('item.unlike', $item->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="icon-button liked">♡</button>
                </form>
                @else
                <form action="{{ route('item.like', $item->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="icon-button">♡</button>
                </form>
                @endif
                @else
                <span class="icon-button">❤️</span>
                @endauth

                <span class="icon-count">{{ $likesCount }}</span>
            </div>

            {{-- コメント --}}
            <div class="icon-group">
                <span class="icon-button">💬</span>
                <span class="icon-count">{{ $commentsCount }}</span>
            </div>
        </div>


        <a href="{{ route('purchase.show', ['item' => $item->id]) }}" class="button--buy">購入手続きへ</a>

        <div class="item-detail__description">
            <h2>商品説明</h2>
            <p>{{ $item->description }}</p>
        </div>

        <div class="item-detail__product-info">
            <h2>商品の情報</h2>
            <dl>
                <dt>カテゴリ</dt>
                <dd>
                    <span class="category-tag">カテゴリ名</span>
                    <span class="category-tag">カテゴリ名2</span>
                </dd>
                <dt>商品の状態</dt>
                <dd>{{ $item->condition_status ?? '良好' }}</dd>
            </dl>
        </div>

        <div class="item-detail__comments-section">
            <h2>コメント({{ $commentsCount }})</h2>

            <div class="comment-list">
                @foreach ($comments as $comment)
                <div class="comment-item">
                    <p class="comment-user">{{ $comment->user->name }}</p>
                    <p class="comment-content">{{ $comment->content }}</p>
                </div>
                @endforeach
            </div>

            @auth
            <div class="comment-form-wrapper">
                <h2>商品へのコメント</h2>
                <form action="{{ route('comments.store', ['item' => $item->id]) }}" method="POST">
                    @csrf
                    @error('content')
                    <p class="error-message" style="color: red; margin-bottom: 5px;">{{ $message }}</p>
                    @enderror

                    <textarea name="content"
                        rows="4"
                        maxlength="255"
                        placeholder="こちらにコメントを入力します。">{{ old('content') }}</textarea>

                    <button type="submit" class="button--comment-submit">コメントを送信する</button>
                </form>
            </div>
            @endauth
        </div>
    </div>
</div>
@endsection