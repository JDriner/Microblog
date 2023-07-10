<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'post_id',
        'content',
        'image',
    ];

    public function user(): BelongsTo{
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function likes(){
        return $this->hasMany(PostLike::class,'post_id','id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class,'post_id','id');
    }

    // If user liked the post
    public function isAuthUserLikedPost(){
        return $this->likes()->where('user_id',  auth()->id())->exists();
     }
}
