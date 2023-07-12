@section('title')
    View Post
@endsection

<x-app-layout>
    <div class="max-w-xl mx-auto">
        @include('post.post-content')
        @include('post.partials.modal-post')
    </div>
    
    @push('scripts')
    <script src="{{ asset('js/modal-post.js') }}"></script>
        <script src="{{ asset('js/post-content.js') }}"></script>
    @endpush
</x-app-layout>
