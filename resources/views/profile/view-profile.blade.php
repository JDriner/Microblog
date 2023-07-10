@section('title')
    Profile - {{ Auth::user()->first_name }}
@endsection

<x-app-layout>
    <div class="flex">
        <!-- User Information -->
        <div class="w-1/3">
            <div class="p-4">
                {{-- Profile information --}}
                @include('profile.partials.profile-info') 
            </div>
        </div>

        <!-- Posts -->
        <div class="w-auto">
            <div class="pt-4">
                <div class="max-w-xl mx-auto">
                    @foreach ($my_posts as $my_post)
                    <div class="bg-white shadow rounded-lg mb-4 p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                @if ($my_post->user->profile_picture == null)
                                <img src="https://w7.pngwing.com/pngs/178/595/png-transparent-user-profile-computer-icons-login-user-avatars-thumbnail.png"
                                    alt="" class="h-12 w-12 rounded-full">
                            @else
                                <img src="{{ url('storage/' . $my_post->user->profile_picture) }}"
                                    alt="{{ $my_post->user->first_name }}" class="h-12 w-12 rounded-full object-cover overflow-hidden border-2 border-indigo-600">
                            @endif
                            </div>
                            <div class="ml-4">
                                <div class="font-semibold text-lg">{{ $my_post->user->first_name . ' ' . $my_post->user->last_name }}
                                </div>
                                <div class="text-gray-600">{{ date('F d, Y - h:i a', strtotime($my_post->created_at)) }}</div>
                            </div>
                            <div class="flex justify-end mt-4">
                                <button type="submit"
                                    class="text-white bg-indigo-500 hover:bg-indigo-600 rounded-full px-4 py-2 ml-2"><i
                                        class="fa-solid fa-pen-to-square"></i></button>
                            </div>

                        </div>
                        <div class="mt-4">
                            <p class="text-gray-800">{{ $my_post->content }}</p>
                            @if ($my_post->image)
                            {{-- <img src="https://www.adorama.com/alc/wp-content/uploads/2018/11/landscape-photography-tips-yosemite-valley-feature-825x465.jpg" alt="Post Image" class="mt-4"> --}}
                            <img src="{{ url('storage/' . $my_post->image) }}" alt="$my_post->image" title="{{ $my_post->content }}"></a>
                        @endif
                        </div>
                        <div class="flex justify-end mt-4">
                            <button type="submit"
                                class="text-white bg-indigo-500 hover:bg-indigo-600 rounded-full px-4 py-2 ml-2"><i
                                    class="fa-regular fa-heart"></i></button>
                            {{-- <button type="submit" class="text-red-700 bg-red-300 hover:bg-indigo-600 rounded-full px-4 py-2 ml-2"><i class="fa-solid fa-heart"></i></button> --}}

                            <button type="submit"
                                class="text-white bg-indigo-500 hover:bg-indigo-600 rounded-full px-4 py-2 ml-2"><i
                                    class="fa-regular fa-comment"></i></button>
                            {{-- <button type="submit" class="text-red-700 bg-red-300 hover:bg-indigo-600 rounded-full px-4 py-2 ml-2"><i class="fa-solid fa-comment"></i></button> --}}

                            <button type="submit"
                                class="text-white bg-indigo-500 hover:bg-indigo-600 rounded-full px-4 py-2 ml-2"><i
                                    class="fa-solid fa-share"></i></button>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
