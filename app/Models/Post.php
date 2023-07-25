<?php

namespace App\Models;

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
        return $this->belongsTo(Post::class, 'post_id', 'id')
            ->withTrashed();
    }

    public function likes()
    {
        return $this->hasMany(PostLike::class);
    }

    public function shares()
    {
        return $this->hasMany(Post::class, 'id', 'post_id')
            ->withTrashed();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // If user liked the post
    public function isAuthUserLikedPost()
    {
        return $this->likes()->where('user_id', auth()->id())
            ->exists();
    }

    // If user commented on the the post
    public function isAuthUserCommentedPost()
    {
        return $this->comments()
            ->where('user_id', auth()->id())
            ->exists();
    }

    public function hasComments()
    {
        return $this->comments()
            ->exists();
    }

    public function firstComment()
    {
        return $this->comments()
            ->latest()
            ->first();
    }

    public function getCommentByLatestDate()
    {
        return $this->comments()
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function sharedPostContent()
    {
        return $this->shares()
            ->get();
    }

    //Posts of users that the current user follows
    public function scopeNewsFeed($query)
    {
        //Get the IDs of the followed users.
        $followingIds = auth()->user()
            ->followings()
            ->pluck('user_following_id');
        // Include own posts in the newsfeed
        $currentUserId = auth()->user()->id;

        return $query->whereIn('user_id', $followingIds)
            ->orWhere('user_id', $currentUserId)
            ->latest();
    }

    // Search posts related to the keyword then returns the posts.
    public function scopeSearchPost($query, $search)
    {
        return $query->where('content', 'LIKE', '%'.$search.'%');
    }

    // ---------------TRENDING TOPICS-------------------------
    public function getHashtags()
    {
        $allHashtags = Post::all()->map(function ($post) {
            preg_match_all('/#\w+/', $post->content, $matches);

            return $matches[0];
        })->flatten();

        return $allHashtags;
    }

    public function scopeCountHashtags()
    {
        $allHashtags = $this->getHashtags();
        $hashtagCounts = $allHashtags->countBy()->sortByDesc(function ($count) {
            return $count;
        });

        return $hashtagCounts;
    }

    public function scopePopularHashtag()
    {
        $hashtagCounts = $this->countHashtags();
        if ($hashtagCounts->isEmpty()) {
            return null; // No hashtags found
        }

        return $hashtagCounts->keys()->first();
    }

    public function scopePostHasHashtag($query, $hashtag)
    {
        return $query->where('id', $this->id)
            ->where('content', 'LIKE', '%'.$hashtag.'%');
    }

    // Most Liked post
    public function scopeMostLikedPost($query)
    {
        return $query->withCount('likes')
            ->orderBy('likes_count', 'desc')
            ->get();
    }
}
