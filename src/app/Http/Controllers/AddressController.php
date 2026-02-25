<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AddressRequest;

class AddressController extends Controller
{
    public function edit(Item $item)
    {
        $user = Auth::user();
        $profile = $user->profile;

        return view('address.edit', compact('item', 'profile'));
    }


    public function update(Request $request, Item $item)
    {
        $request->validate([
            'post_code' => 'required',
            'address' => 'required',
        ]);

        $profile = Profile::where('user_id', auth()->id())->first();
        $profile->update([
            'post_code' => $request->post_code,
            'address' => $request->address,
            'building' => $request->building,
        ]);

        // ✅ 更新後は購入画面へ戻す
        return redirect()->route('purchase.show', $item->id);
    }
}
