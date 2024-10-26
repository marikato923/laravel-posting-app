<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // 一つの投稿は一人のユーザーに属する
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // いいね実装
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function likeByUser($userId)
    {
        return $this->likes()->where('user_id', $userId)->exists();
    }

    public function getLikesCount()
{
    return $this->likes()->count();
}

}
