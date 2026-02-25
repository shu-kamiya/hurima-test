<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\SellController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AddressController;

// 商品一覧
Route::get('/', [ItemController::class, 'index'])->name('items.index');

// 商品詳細（← item_id 廃止）
Route::get('/item/{item}', [ItemController::class, 'show'])->name('items.show');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);


Route::middleware('auth')->group(function () {

    Route::post('/logout', function (Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    })->name('logout');

    // いいね
    Route::post('/item/{item}/like', [ItemController::class, 'like'])->name('item.like');
    Route::delete('/item/{item}/unlike', [ItemController::class, 'unlike'])->name('item.unlike');

    // コメント
    Route::post('/item/{item}/comment', [CommentController::class, 'store'])->name('comments.store');

    // 出品
    Route::get('/sell', [SellController::class, 'create'])->name('sell.create');
    Route::post('/sell', [SellController::class, 'store'])->name('sell.store');

    // 購入
    Route::get('/purchase/{item}', [PurchaseController::class, 'show'])->name('purchase.show');
    Route::post('/purchase/{item}', [PurchaseController::class, 'store'])->name('purchase.store');

    // 住所変更
    Route::get('/purchase/address/edit/{item}', [AddressController::class, 'edit'])->name('address.edit');
    Route::put('/purchase/address/update/{item}', [AddressController::class, 'update'])->name('address.update');

    // マイページ
    Route::get('/mypage', [MypageController::class, 'show'])->name('mypage');
    Route::get('/mypage/profile/edit', [MypageController::class, 'editProfile'])->name('profile.edit');
    Route::put('/mypage/profile', [MypageController::class, 'updateProfile'])->name('profile.update');
});
