@section('title')
    Follow List
@endsection

<x-app-layout>
    <!-- Search Box -->
    {{-- @include('home.search.search-box') --}}

    @include('profile.partials.follow-tab')

    @push('scripts')
        <script src="{{ asset('js/follower.js') }}"></script>
        <script src="{{ asset('js/modal-post.js') }}"></script>
        <script src="{{ asset('js/post-content.js') }}"></script>
    @endpush
</x-app-layout>
