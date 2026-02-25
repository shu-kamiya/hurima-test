<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Purchase;
use App\Models\Profile;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    public function show(Item $item)
    {
        $user = Auth::user();
        $profile = Profile::where('user_id', $user->id)->first();

        $paymentMethods = [
            'convenience' => 'コンビニ払い',
            'card' => 'カード払い',
        ];

        $initialPaymentMethod = 'convenience';

        return view('purchase.checkout', compact(
            'item',
            'profile',
            'paymentMethods',
            'initialPaymentMethod'
        ));
    }

    public function store(Request $request, Item $item)
    {
        $request->validate([
            'payment_method' => ['required', 'in:convenience,card'],
        ]);

        if ($item->is_sold) {
            return back()->withErrors(['error' => 'この商品はすでに購入されています。']);
        }

        DB::transaction(function () use ($item, $request) {

            Purchase::create([
                'user_id' => Auth::id(),
                'item_id' => $item->id,
                'payment_method' => $request->payment_method,
                'price' => $item->price,
            ]);

            $item->update([
                'is_sold' => true,
            ]);
        });

        return redirect()
            ->route('items.index')
            ->with('success', '商品を購入しました。');
    }
}
