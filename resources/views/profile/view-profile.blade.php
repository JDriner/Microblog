@section('title')
    Profile
@endsection
<x-app-layout>
    @if (Auth::user()->id != $user->id)
        <x-slot name="header">
            <div class="flex items-center">
                <h2 class="ml-2 font-semibold text-xs text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('You are viewing ' . $user->first_name . '\'s profile') }}
                </h2>
            </div>
        </x-slot>
    @endif
    <div class="flex">
        <!-- User Information -->
        <div class="w-2/5">
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
        <div class="w-3/5">
            @if ($user->id == Auth::user()->id)
                <!-- Creation of post (with the modal) -->
                @include('post.create-post')
            @endif
            <div class="max-w-xl mx-auto">
                <!-- No posts yet -->
                @if (count($myPosts) < 1)
                    @if ($user->id == Auth::user()->id)
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
                    @else
                        <div class="bg-white dark:bg-slate-800 dark:text-white shadow rounded-lg mt-3 p-6">
                            <div class="flex">
                                <h1 class="text-black dark:text-white text-center">
                                    {{ $user->first_name }} does not have any posts yet!
                                </h1>
                            </div>
                        </div>
                    @endif
                @endif
                <!-- user has posts -->
                @foreach ($myPosts as $post)
                    @include('post.post-content')
                @endforeach
                <div class="my-4 mx-2">
                    {{ $myPosts->links('pagination::tailwind') }}
                </div>
            </div>
        </div>
    </div>
    @include('flash.flash')
</x-app-layout>

