@extends('layouts.app')

@section('header')
@include('layouts.app_header')
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage/mypage.css') }}">
@endsection

@section('content')
<div class="mypage-container">

    <div class="user-header">
        <div class="profile-image-placeholder"></div>

        <h1 class="user-name">{{ $user->name }}</h1>

        <a href="{{ route('profile.edit') }}" class="button--profile-edit">プロフィールを編集</a>
    </div>

    <div class="item-tabs">
        <a href="?tab=selling" class="item-tabs__link {{ $tab == 'selling' ? 'is-active' : '' }}">
            出品した商品
        </a>
        <a href="?tab=purchased" class="item-tabs__link {{ $tab == 'purchased' ? 'is-active' : '' }}">
            購入した商品
        </a>
    </div>

    <div class="item-list-wrapper">
        <div class="item-list">
            @php
            // 現在のタブに応じて表示するアイテムリストを決定
            $currentItems = ($tab == 'selling')
            ? $notSoldItems->merge($soldItems) // 出品中の商品 + 売却済みの商品
            : $purchasedItems; // 購入した商品
            @endphp

            @forelse ($currentItems as $item)
            <div class="item-card">
                <a href="{{ route('items.show', $item->id) }}" class="item-card-link">
                    <div class="item-image-wrapper">
                        <img src="{{ asset('storage/' . $item->image_url) }}" alt="{{ $item->name }}">
                        @if ($item->is_sold)
                        <div class="sold-overlay">sold</div>
                        @endif
                    </div>
                    <p class="item-name">{{ $item->name }}</p>
                    <p class="item-brand">
                        {{ $item->brand_name ?? 'ブランド不明' }}
                    </p>
                    <p class="item-price">
                        ¥{{ number_format($item->price) }}
                    </p>
                    <p class="item-condition">
                        {{ $item->condition }}
                    </p>
                </a>
            </div>

            @empty
            <p class="no-items-message">
                {{ $tab == 'selling' ? '現在出品中の商品はありません。' : '購入した商品履歴がありません。' }}
            </p>
            @endforelse
        </div>
    </div>
</div>
@endsection