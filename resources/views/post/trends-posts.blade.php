@foreach ($posts as $post)
    @if ($post->postHasHashtag($hashtag)->exists())
        @include('post.post-content')
    @endif
@endforeach
