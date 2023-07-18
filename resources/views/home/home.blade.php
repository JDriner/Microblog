@section('title')
    Home
@endsection

<x-app-layout>
    <!-- Search Box -->
    @include('home.search.search-box')
    <div class="flex">
        <div class="w-1/4 mx-2"></div>
        <!-- Left side -->
        <div class="w-2/4 mx-2">
            <!-- Middle -->


            <!-- Post Create -->
            @include('post.create-post')
            @include('post.partials.modal-post')

            <!-- Display Post -->
            <div class="max-w-xl mx-auto">
                @foreach ($posts as $post)
                    @include('post.post-content')
                @endforeach

                <div class="my-4 mx-2">
                        {{ $posts->links('pagination::tailwind') }}
                </div>
            </div>
        </div>
        <div class="w-1/4 mx-2 mr-12">
            @if (!$suggestedUsers->isEmpty())
                <!-- Right side -->
                <h1 class="text-sm text-slate-900 dark:text-gray-300">Suggested Users</h1>
                @foreach ($suggestedUsers as $user)
                    @include('home.search.user-result')
                @endforeach
            @endif
            
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
