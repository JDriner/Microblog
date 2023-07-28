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
        $user = auth()->user();

        return $query->select('posts.*')
            ->leftJoin('user_followers', 'user_followers.user_following_id', '=', 'posts.user_id')
            ->where(function ($query) use ($user) {
                $query->where('user_followers.user_id', $user->id)
                    ->orWhere('posts.user_id', $user->id);
            })
            ->distinct('posts.id')
            ->latest();
    }

    // Search posts related to the keyword then returns the posts.
    public function scopeSearchPost($query, $search)
    {
        return $query->where('content', 'LIKE', '%' . $search . '%');
    }

    // ---------------RECENT TRENDING TOPICS-------------------------
    public function getHashtags()
    {
        $takeValue = config('microblog.default_chunk_count');

        // Retrieve the first 5000 latest posts
        $latestPosts = Post::latest()
            ->take($takeValue)
            ->get();

        // Extract hashtags from the content of each post
        $allHashtags = $latestPosts
            ->flatMap(function ($post) {
                preg_match_all('/#\w+/', $post->content, $matches);
                return $matches[0];
            });

        return $allHashtags;
    }

    public function popularHashtags()
    {
        $allHashtags = $this->getHashtags();
        $hashtagCounts = $allHashtags
            ->countBy()
            ->sortByDesc(function ($count) {
                return $count;
            });

        return $hashtagCounts;
    }

    public function countHashtags()
    {
        $allHashtags = $this->getHashtags();
        $hashtagCounts = $allHashtags
            ->countBy()
            ->sortByDesc(function ($count) {
                return $count;
            });

        return $hashtagCounts;
    }

    public function scopePostHasHashtag($query, $hashtag)
    {
        return $query->where('id', $this->id)
            ->where('content', 'LIKE', '%' . $hashtag . '%');
    }

    // Most Liked post
    public function scopeMostLikedPost($query)
    {
        return $query->withCount('likes')
            ->orderBy('likes_count', 'desc')
            ->get();
    }
}