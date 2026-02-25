@extends('layouts.app')

@section('header')
@include('layouts.app_header')
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/purchase/checkout.css') }}">
@endsection

@section('content')
<form action="{{ route('purchase.store', $item->id) }}" method="POST">
    @csrf

    <div class="checkout-wrapper">

        <!-- 左カラム -->
        <div class="checkout-left">

            <div class="item-top">
                <img src="{{ asset('storage/' . $item->image_url) }}" class="item-image">

                <div>
                    <div class="item-name">{{ $item->name }}</div>
                    <div class="item-price">¥{{ number_format($item->price) }}</div>
                </div>
            </div>

            <div class="line"></div>

            <div class="payment-section">
                <div class="payment-method-title">支払い方法</div>

                <select name="payment_method" class="payment-method-select">
                    <option value="">選択してください</option>
                    <option value="convenience"
                        {{ old('payment_method') == 'convenience' ? 'selected' : '' }}>
                        コンビニ払い
                    </option>
                    <option value="card"
                        {{ old('payment_method') == 'card' ? 'selected' : '' }}>
                        カード払い
                    </option>
                </select>

                @error('payment_method')
                <p style="color:red;">{{ $message }}</p>
                @enderror
            </div>

            <div class="line"></div>

            <div class="address-section">
                <span class="title">配送先</span>
                <a href="{{ route('address.edit', ['item' => $item->id]) }}" class="change-link">
                    変更する
                </a>

                <div class="address-building">
                    <p>〒 {{ $profile->post_code ?? 'XXX-YYYY' }}</p>
                    <p>{{ $profile->address ?? '' }}</p>
                    <p>{{ $profile->building }}</p>
                </div>
            </div>

            <div class="line"></div>

        </div>

        <!-- 右カラム -->
        <div class="purchase-summary">

            <div class="purchase-summary__box">
                <div class="purchase-summary__row">
                    <span>商品代金</span>
                    <span>¥{{ number_format($item->price) }}</span>
                </div>

                <div class="purchase-summary__row">
                    <span>支払い方法</span>
                    <span>{{ old('payment_method') ?? '未選択' }}</span>
                </div>
            </div>

            <button type="submit" class="purchase-summary__button">
                購入する
            </button>

        </div>

    </div>
</form>


@endsection