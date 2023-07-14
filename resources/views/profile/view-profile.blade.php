@section('title')
    Profile
@endsection

<x-app-layout>
    @if (Auth::user()->id != $user->id)
        <x-slot name="header">
            <div class="flex items-center">
                <a dir="ltr" type="button" href="{{ URL::previous() }}"
                    class=" text-sm bg-indigo-500 hover:bg-indigo-600 text-white px-2 rounded-s-lg mr-4">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
                <h2 class="ml-2 font-semibold text-xs text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('You are viewing ' . $user->first_name . '\'s profile') }}
                </h2>
            </div>
        </x-slot>
    @endif


    <div class="flex">
        <!-- User Information -->
        <div class="w-1/3">
            <div class="px-4 py-2">
                {{-- Profile information --}}
                @if ($user->id == Auth::user()->id)
                    {{-- viewing own profile --}}
                    @include('profile.partials.profile-info')
                @else
                    {{-- viewing other user's profile --}}
                    @include('profile.partials.user-profile-info')
                @endif
            </div>
        </div>

        <!-- Posts -->
        <div class="w-2/3">
            @if ($user->id == Auth::user()->id)
                <!-- Creation of post (with the modal) -->
                @include('post.create-post')
                @include('post.partials.modal-post')
            @endif


            <div class="max-w-xl mx-auto">
                <!-- No posts yet -->
                @if (count($my_posts) < 1)
                    <div class="bg-white dark:bg-slate-800 dark:text-white shadow rounded-lg mt-3 p-6">
                        <div class="flex justify-between">
                            <h1 class="text-black dark:text-white">
                                You do not have any posts yet!
                                <span
                                    class="createPost text-indigo-800 dark:text-indigo-300 font-bold cursor-pointer underline underline-offset-2">
                                    Create one now!
                                </span>
                            </h1>
                        </div>
                    </div>
                @endif
                <!-- user has posts -->
                @foreach ($my_posts as $post)
                    @include('post.post-content')
                @endforeach
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="{{ asset('js/follower.js') }}"></script>
        <script src="{{ asset('js/modal-post.js') }}"></script>
        <script src="{{ asset('js/post-content.js') }}"></script>
    @endpush
</x-app-layout>
