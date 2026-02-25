<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Comment;
use App\Models\Like;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $tab = $request->get('tab', 'recommend');
        $keyword = $request->get('keyword');

        $query = Item::query()->where('is_sold', false);

        if ($tab === 'recommend') {

            if (Auth::check()) {
                $query->where('user_id', '!=', Auth::id());
            }

            if ($keyword) {
                $query->where('name', 'like', "%{$keyword}%");
            }

            $items = Item::latest()->get();
        }

        /** @var \App\Models\User $user */
        $user = Auth::user();

        if ($tab === 'mylist' && $user) {
            $items = $user
                ->likes()
                ->when($keyword, fn($q) => $q->where('name', 'like', "%{$keyword}%"))
                ->get();
        }


        return view('items.index', compact('items', 'tab', 'keyword'));
    }

    public function show(Item $item)
    {
        $likesCount = $item->likes()->count();

        $comments = $item->comments()->with('user')->get();
        $commentsCount = $comments->count();

        $isLiked = false;
        if (Auth::check()) {
            $isLiked = $item->likes()->where('user_id', Auth::id())->exists();
        }

        return view('items.show', compact(
            'item',
            'likesCount',
            'comments',
            'commentsCount',
            'isLiked'
        ));
    }

    public function like(Item $item)
    {
        $exists = Like::where('user_id', Auth::id())
        ->where('item_id', $item->id)
        ->exists();

        if (!$exists) {
            Like::create([
                'user_id' => Auth::id(),
                'item_id' => $item->id,
            ]);
        }
        return back();
    }

    public function unlike(Item $item)
    {
        Like::where('user_id', Auth::id())
        ->where('item_id', $item->id)
        ->delete();

        return back();
    }
}
