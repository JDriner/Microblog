@section('title')
    Showing results for " {{  $search }}"
@endsection

<x-app-layout>
    <!-- Search Box -->
    @include('home.search.search-box')

    @if ($users->isEmpty() && $posts->isEmpty())
        <div class="max-w-xl mx-auto">
            <h1 class="text-xs text-slate-900 dark:text-white mt-4">
                No results found related to "{{ $search }}"
            </h1>
        </div>
    @endif

    @if (!$users->isEmpty())
        <!-- Display Results for Users -->
        <div class="max-w-xl mx-auto">
            <h1 class="text-xs text-slate-900 dark:text-white mt-4">
                Users related to "{{ $search }}"
            </h1>
            @foreach ($users as $user)
                @include('home.search.user-result')
            @endforeach
        </div>
    @endif

    @if (!$posts->isEmpty())
        @include('post.partials.modal-post')
        <!-- Display Results for Post -->
        <div class="max-w-xl mx-auto">
            <h1 class="text-xs text-slate-900 dark:text-white mt-4">
                Posts related to "{{ $search }}"
            </h1>
            @foreach ($posts as $post)
                @include('post.post-content')
            @endforeach
        </div>
    @endif

    @push('scripts')
        <script src="{{ asset('js/follower.js') }}"></script>
        <script src="{{ asset('js/modal-post.js') }}"></script>
        <script src="{{ asset('js/post-content.js') }}"></script>
    @endpush
</x-app-layout>
