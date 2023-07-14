<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function share(): BelongsTo
    {
        return $this->belongsTo(Post::class, 'post_id', 'id');
    }

    public function likes()
    {
        return $this->hasMany(PostLike::class);
    }

    public function shares()
    {
        return $this->hasMany(Post::class, 'post_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // If user liked the post
    public function isAuthUserLikedPost()
    {
        return $this->likes()->where('user_id', auth()->id())->exists();
    }

    // If user commented on the the post
    public function isAuthUserCommentedPost()
    {
        return $this->comments()->where('user_id', auth()->id())->exists();
    }

    public function hasComments()
    {
        return $this->comments()->exists();
    }

    public function firstComment()
    {
        return $this->comments()->latest()->first();
    }

    public function getCommentByLatestDate()
    {
        return $this->comments()->orderBy('created_at', 'desc')->get();
    }
    public function sharedPostContent()
    {
        return $this->shares()->get();
    }

    //Posts of users that the current user follows
    public function scopeFollowedUserPost(Builder $query): void
    {
        $query->where('active', 1);
    }
}
