@section('title')
    Follow List
@endsection

<x-app-layout>
    <!-- Search Box -->
    {{-- @include('home.search.search-box') --}}

    @include('profile.partials.follow-tab')

    @push('scripts')
        {{-- <script src="{{ asset('js/load-page.js') }}"></script> --}}
    @endpush
</x-app-layout>
