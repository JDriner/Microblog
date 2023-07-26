@section('title')
    Home
@endsection

<x-app-layout>
    <!-- Search Box -->
    @include('home.search.search-box')
    <div class="flex">
        <div class="w-1/4 ml-4 ">
            @if (!$hashtags->isEmpty())
                <h1 class="text-sm text-slate-900 dark:text-gray-300">
                    Trending hashtags
                </h1>
                <a href="{{ route('trends') }}">

                    <div class="bg-white dark:bg-slate-800 shadow rounded-lg mt-1 py-2">
                        @foreach ($hashtags as $hashtag => $count)
                            <ul class="list-none text-xs italic text-slate-700 dark:text-white px-2 py-2">
                                <li>{{ $hashtag }}</li>
                            </ul>
                        @endforeach
                    </div>
                </a>
            @endif
        </div>

        <div class="w-2/4 mx-2">
            <!-- Create post component -->
            @include('post.create-post')

            <!-- Display Posts -->
            <div class="max-w-xl mx-auto" id="post-data">
                @include('post.home-posts')
            </div>

            <!-- pagination of posts -->
            <div class="max-w-xl mx-auto">
                <div class="my-4 mx-2 flex justify-center">
                    {{ $posts->links('pagination::tailwind') }}

                </div>
            </div>
        </div>

        <div class="w-1/4 mr-12">
            <!-- Display suggested users -->
            @if (!$suggestedUsers->isEmpty())
                <h1 class="text-sm text-slate-900 dark:text-gray-300">
                    Suggested Users
                </h1>
                @php
                    $counter = 0;
                @endphp
                @foreach ($suggestedUsers as $user)
                    @if ($counter >= 4)
                    @break
                @endif
                @include('home.search.user-result')
                @php
                    $counter++;
                @endphp
            @endforeach
        @endif
    </div>
</div>


<!-- Loading pages -->
{{-- @include('home.load-page') --}}

<!-- Flash Messages-->
@include('flash.flash')

@push('scripts')
    {{-- <script src="{{ asset('js/load-page.js') }}"></script> --}}
@endpush
</x-app-layout>
