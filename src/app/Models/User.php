<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Profile;
use App\Models\Item;
use App\Models\Purchase;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function likes()
    {
        return $this->belongsToMany(Item::class, 'likes', 'user_id', 'item_id');
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function sellingItems()
    {
        return $this->hasMany(Item::class, 'user_id');
    }

    public function purchases()
    {
        return $this->hasMany(Purchase::class, 'user_id');
    }
}
