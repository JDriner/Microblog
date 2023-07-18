@section('title')
    Trends
@endsection

<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <a dir="ltr" type="button" href="{{ URL::previous() }}"
                class=" text-sm bg-indigo-500 hover:bg-indigo-600 text-white px-2 rounded-s-lg mr-4">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
            <h2 class="ml-2 font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Trending posts now! <i class="fa-solid fa-fire" style="color: #f5963d;"></i>
            </h2>
        </div>
    </x-slot>
    <!-- Search Box -->
    {{-- @include('home.search.search-box') --}}
    <div class="flex">
        <div class="w-1/4 mx-2"></div>
        <!-- Left side -->
        <div class="w-2/4 mx-2">
            <!-- Display Post -->
            <div class="max-w-xl mx-auto">
                <p class="text-sm text-slate-800 dark:text-white mt-4">
                    Top liked posts! 
                </p>
                @foreach ($mostLikedPost as $post)
                    @include('post.post-content')
                @endforeach
            </div>
            <!-- Middle -->
            @foreach ($hashtags as $hashtag => $count)
                <p class="text-sm text-slate-800 dark:text-white mt-4">
                    Topics related with <span class="font-extrabold">"{{ $hashtag }}"</span>
                </p>
                <!-- Display Post -->
                <div class="max-w-xl mx-auto">
                    @foreach ($posts as $post)
                        @if ($post->postHasHashtag($hashtag)->exists())
                            @include('post.post-content')
                        @endif
                    @endforeach
                </div>
            @endforeach
        </div>

    </div>


    <!-- Flash Messages-->
    @include('flash.comment-flash')
    @push('scripts')
        <script src="{{ asset('js/follower.js') }}"></script>
        <script src="{{ asset('js/modal-post.js') }}"></script>
        <script src="{{ asset('js/post-content.js') }}"></script>
    @endpush
</x-app-layout>
