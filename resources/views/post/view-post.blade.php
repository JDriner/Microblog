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
        @if ($post->trashed())
            <div class="bg-white dark:bg-slate-800 dark:text-white shadow rounded-lg p-4 mt-12">
                <div class="flex justify-center mb-4">
                    <h1 class="text-sm">
                        This post is no longer available. It may have been deleted by the original owner.
                    </h1>
                </div>
            </div>
        @else
            @include('post.post-content')
        @endif

    </div>

    <!-- Flash Messages-->
    @include('flash.flash')
    @push('scripts')
        {{-- <script src="{{ asset('js/load-page.js') }}"></script> --}}
    @endpush
</x-app-layout>
