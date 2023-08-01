@section('title')
    Trends
@endsection

<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <h2 class="ml-2 font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Trending posts now! <i class="fa-solid fa-fire" style="color: #f5963d;"></i>
            </h2>
        </div>
    </x-slot>
    <!-- Search Box -->
    {{-- @include('post.create-post') --}}
    @include('home.search.search-box')
    <div class="flex">
        <div class="w-1/4 mx-2">
            <div class="fixed left-3">
                <h1 class="text-sm text-slate-900 dark:text-gray-300">
                    Trending hashtags
                </h1>
                <div class="bg-white dark:bg-slate-800 dark:text-white shadow rounded-lg mt-1 p-3">
                    @foreach ($hashtags as $hashtag => $count)
                        <a href="#{{ $hashtag }}">
                            <ul class="list-none" class="text-sm italic text-slate-300">
                                <li>{{ $hashtag }}</li>
                            </ul>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- Left side -->
        <div class="w-2/4 mx-2">
            <!-- Display Post -->
            <p class="text-sm text-slate-800 dark:text-white mt-4">
                Top liked posts!
            </p>
            <div class="max-w-xl mx-auto">

                @foreach ($mostLikedPost as $post)
                    @include('post.post-content')
                @endforeach
            </div>
            <!-- Middle -->

            @foreach ($hashtags as $hashtag => $count)
                <p class="text-sm text-slate-800 dark:text-white mt-4" id="{{ $hashtag }}">
                    Topics related with <span class="font-extrabold">"{{ $hashtag }}"</span>
                </p>
                <!-- Display Post -->
                <div class="max-w-xl mx-auto mb-4">
                    @include('post.trends-posts')
                </div>
            @endforeach
        </div>

    </div>

    <!-- Flash Messages-->
    @include('flash.flash')
</x-app-layout>
