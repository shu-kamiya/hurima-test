<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ExhibitionRequest;

class SellController extends Controller
{
    public function create()
    {
        return view('sell.sell', [
            'categories' => Category::all(), // ← これが無いと表示されない
        ]);
    }

    public function store(ExhibitionRequest $request) // ← Requestじゃダメ！
    {
        $imagePath = null;

        if ($request->hasFile('image')) {
            $filename = uniqid() . '.' . $request->file('image')->getClientOriginalExtension();

            $request->file('image')->storeAs('public/items', $filename);

            $imagePath = 'items/' . $filename;
        }

        DB::transaction(function () use ($request, $imagePath) {
            $item = Item::create([
                'user_id' => Auth::id(),
                'name' => $request->name,
                'brand' => $request->brand,
                'description' => $request->description,
                'price' => $request->price,
                'condition' => $request->condition,
                'image_url' => $imagePath,
                'is_sold' => false,
            ]);

            $item->categories()->attach($request->category_ids);
        });

        return redirect()->route('mypage')->with('success', '商品を出品しました！');
    }
}
