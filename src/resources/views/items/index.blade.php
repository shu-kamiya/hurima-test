@extends('layouts.app')

@section('header')
@include('layouts.app_header')
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/items/index.css') }}">
@endsection

@section('content')
<div class="item-list-scroll">
    <div class="item-tabs">
        <a href="{{ route('items.index', ['tab' => 'recommend', 'keyword' => $keyword]) }}"
            class="item-tabs__link {{ $tab == 'recommend' ? 'is-active' : '' }}">
            おすすめ
        </a>

        <a href="{{ route('items.index', ['tab' => 'mylist', 'keyword' => $keyword]) }}"
            class="item-tabs__link {{ $tab == 'mylist' ? 'is-active' : '' }}">
            マイリスト
        </a>
    </div>

    <div class="item-list-container">

        @if ($tab == 'mylist' && !Auth::check())
        <p>マイリストを表示するには、ログインが必要です。</p>

        @elseif ($items->isEmpty())
        <p>現在、表示する商品はありません。</p>

        @else
        @foreach ($items as $item)
        <div class="item-card">
            <a href="{{ route('items.show', $item->id) }}">
                <div class="item-card__image-wrapper">
                    <img
                        src="{{ asset('storage/' . $item->image_url) }}"
                        alt="{{ $item->name }}">
                    @if ($item->is_sold)
                    <div class="item-card__sold-overlay">SOLD</div>
                    @endif
                </div>
                <p class="item-card__name">{{ $item->name }}</p>
            </a>
        </div>
        @endforeach
        @endif
    </div>
</div>
@endsection