@section('title')
    Home
@endsection

<x-app-layout>
    <!-- Search Box -->
    @include('home.search.search-box')

    <!-- Post Create -->
    @include('post.create-post')
    @include('post.partials.modal-post')

    <!-- Display Post -->
    <div class="max-w-xl mx-auto">
        @foreach ($posts as $post)
            @include('post.post-content')
        @endforeach
    </div>

    @push('scripts')
        <script src="{{ asset('js/modal-post.js') }}"></script>
        <script src="{{ asset('js/post-content.js') }}"></script>
    @endpush
</x-app-layout>
