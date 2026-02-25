<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;
use App\Models\Item;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(CommentRequest $request, Item $item)
    {
        $comment = new Comment();
        $comment->user_id = Auth::id();
        $comment->item_id = $item->id;
        $comment->content = $request->input('content');
        $comment->save();

        return back()->with('success', 'コメントを送信しました。');
    }
}
