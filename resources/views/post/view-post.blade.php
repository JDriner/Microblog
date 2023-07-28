@section('title')
    View Post
@endsection

<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            {{-- <a dir="ltr" type="button" href="{{ URL::previous() }}"
                class=" bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded-s-lg mr-4">
                <i class="fa-solid fa-arrow-left"></i>
            </a> --}}

            <h2 class="ml-2 font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __($post->user->first_name . '\'s Post') }}
            </h2>
        </div>
    </x-slot>

    <div class="max-w-xl mx-auto">
        @include('post.post-content')
    </div>

    <!-- Flash Messages-->
    @include('flash.flash')
    @push('scripts')
        {{-- <script src="{{ asset('js/load-page.js') }}"></script> --}}
    @endpush
</x-app-layout>
