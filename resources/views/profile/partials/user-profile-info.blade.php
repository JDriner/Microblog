<div class="bg-white shadow rounded-lg mb-4 p-6">
    <div class="flex justify-center mb-4">
        @if ($user->profile_picture == null)
            <img src="{{ asset('images/user-logo.png') }}"
                alt="Profile Picture"
                class="w-64 h-64 object-cover rounded-full overflow-hidden border-2 border-indigo-600">
        @else
            <img src="{{ url('storage/' . $user->profile_picture) }}" alt="Profile Picture"
                class="w-64 h-64 object-cover rounded-full overflow-hidden border-2 border-indigo-600">
        @endif
    </div>
    
    <div class="flex justify-center mb-4">
        <div>
        <button
            class="followBtn text-sm text-black bg-gray-100 outline outline-offset-2 outline-indigo-500 hover:bg-indigo-600 hover:text-white rounded-full px-4 py-0 ml-2">Follow</button>
        </div>
            <div class="flex flex-wrap py-3 px-5">
                <div class="border-2">30 Followers</div>
                <div class="border-2">10 Following</div>
              </div>
    </div>

    <div class="flex justify-center flex-col items-center">
        <div class="text-center mb-4">
            <h2 class="text-xl font-bold">{{ $user->first_name . ' ' . $user->last_name }}</h2>
            <h2 class="text-sm font-light">{{ $user->email }}</h2>
        </div>
    </div>
</div>

