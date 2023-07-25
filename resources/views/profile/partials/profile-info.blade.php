<div class="bg-white dark:bg-slate-800 dark:text-white shadow rounded-lg mb-4 p-6">
    <div class="flex justify-center mb-4">
        @if (Auth::user()->profile_picture == null)
            <img src="{{ asset('images/user-logo.png') }}" alt="Profile Picture"
                class="w-64 h-64 object-cover rounded-full overflow-hidden border-2 border-indigo-600">
        @else
            <img src="{{ url('storage/' . Auth::user()->profile_picture) }}" alt="Profile Picture"
                class="w-64 h-64 object-cover rounded-full overflow-hidden border-2 border-indigo-600">
        @endif
    </div>

    <div class="flex justify-center mb-4">
        <button
            class="changePicModal text-sm outline  outline-indigo-500 dark:text-slate-100  hover:bg-indigo-500 hover:text-white dark:hover:text-white rounded-full px-4 py-2 ml-2">
            Change profile picture
        </button>
    </div>

    <div class="flex justify-center flex-col items-center">
        <div class="text-center mb-4">
            <h2 class="text-xl font-bold">{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}</h2>
            <h2 class="text-sm font-light">{{ Auth::user()->email }}</h2>
        </div>
        <div class="mb-4">
            <a href="{{ route('listFollows', 'all') }}">
                <p class="text-xs text-gray-600 dark:text-gray-300 hover:text-slate-900">
                    {{ Auth::user()->followers->count() }} Followers | {{ Auth::user()->followings->count() }} Following
                </p>
            </a>
        </div>
        <div class="mt-4">
            <a class="text-white bg-indigo-600 hover:bg-indigo-500 rounded-lg px-4 py-2"
                href="{{ route('profile.edit') }}">
                Edit Profile
            </a>
        </div>
    </div>
</div>

@include('profile.partials.change-profile-picture-modal')

@push('scripts')
    <script src="{{ asset('js/profile-info.js') }}"></script>
@endpush
