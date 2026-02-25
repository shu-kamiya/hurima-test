<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'brand',
        'description',
        'price',
        'condition',
        'image_url',
        'is_sold', // ← これを追加！！！！！！
    ];

    protected $casts = [
        'is_sold' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->belongsToMany(User::class, 'likes', 'item_id', 'user_id');
    }

    public function getIsLikeAttribute()
    {
        if (Auth::check()) {
            return $this->likes()->where('user_id', Auth::id())->exists();
        }
        return false;
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->latest();
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'item_categories');
    }
}
