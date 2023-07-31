<div class="bg-white dark:bg-slate-800 dark:text-white shadow rounded-lg mb-4 p-6">
    <div class="flex justify-center mb-4">
        @if ($user->profile_picture == null)
            <img src="{{ asset('images/user-logo.png') }}" alt="Profile Picture"
                class="w-64 h-64 object-cover rounded-full overflow-hidden border-2 border-indigo-600">
        @else
            <img src="{{ url('storage/' . $user->profile_picture) }}" alt="Profile Picture"
                class="w-64 h-64 object-cover rounded-full overflow-hidden border-2 border-indigo-600">
        @endif
    </div>

    <div class="flex justify-center flex-col items-center">
        <div class="text-center mb-4">
            <h2 class="text-xl font-bold">{{ $user->first_name . ' ' . $user->last_name }}</h2>
            <h2 class="text-sm font-light">{{ $user->email }}</h2>
        </div>
        <div class="mb-4">
            <p class="text-xs text-gray-300">
            <p>{{ $user->followers->count() }} Followers | {{ $user->followings->count() }} Following</p>
            </p>
        </div>
        <div class="mt-2">
            @if ($user->isUserFollowed())
                <button type="button" action="/unfollow/{{ $user->id }}"
                    class="follow_unfollow dark:text-white border-2 border-indigo-500  hover:bg-indigo-500 rounded-md px-6 py-1">
                    Unfollow</button>
            @else
                <button type="button" action="/follow/{{ $user->id }}"
                    class="follow_unfollow text-white bg-indigo-600 hover:bg-indigo-500 rounded-md px-6 py-1">
                    Follow</button>
            @endif
        </div>
    </div>
</div>
