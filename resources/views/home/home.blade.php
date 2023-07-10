@section('title')
    Home
@endsection

<x-app-layout>
    <!-- Search Box -->
    <div class="flex justify-center mt-8">
        <div class="w-full max-w-lg">
            <form action="" method="GET">
                <div class="flex items-center bord rounded-full">
                    <input type="text" name="query" id="query" placeholder="Search for posts, users..." class="px-4 py-2 w-full rounded-full focus:outline-none" />

                    <button type="submit" class="text-white bg-indigo-500 hover:bg-indigo-600 rounded-full px-4 py-2 ml-2">Search</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Post Create -->
    @include('home.partials.create-post')
    {{-- @include('sample.sample') --}}


    <!-- Post Display -->
    <div class="mt-8">
        <div class="max-w-xl mx-auto">
            @foreach ($posts as $post)
                <div class="bg-white shadow rounded-lg mt-2 p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <img src="https://w7.pngwing.com/pngs/178/595/png-transparent-user-profile-computer-icons-login-user-avatars-thumbnail.png" alt="" class="h-12 w-12 rounded-full">
                        </div>
                        <div class="ml-4">
                            <div class="font-semibold text-lg">{{ $post->user->first_name." ".$post->user->last_name }}</div>
                            <div class="text-gray-600">{{ date('F d, Y - h:i a', strtotime($post->created_at)) }}</div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <p class="text-gray-800">{{ $post->content }}</p>
                        @if ($post->image)
                        {{-- <img src="https://www.adorama.com/alc/wp-content/uploads/2018/11/landscape-photography-tips-yosemite-valley-feature-825x465.jpg" alt="Post Image" class="mt-4"> --}}
                        <img src="{{  url('storage/'.$post->image) }}" alt="" title=""></a>

                        @endif
                    </div>
                    <div class="flex justify-end mt-4">
                          <button type="submit" class="text-white bg-indigo-500 hover:bg-indigo-600 rounded-full px-4 py-2 ml-2"><i class="fa-regular fa-heart"></i></button>
                          {{-- <button type="submit" class="text-red-700 bg-red-300 hover:bg-indigo-600 rounded-full px-4 py-2 ml-2"><i class="fa-solid fa-heart"></i></button> --}}

                          <button type="submit" class="text-white bg-indigo-500 hover:bg-indigo-600 rounded-full px-4 py-2 ml-2"><i class="fa-regular fa-comment"></i></button>
                          {{-- <button type="submit" class="text-red-700 bg-red-300 hover:bg-indigo-600 rounded-full px-4 py-2 ml-2"><i class="fa-solid fa-comment"></i></button> --}}

                          <button type="submit" class="text-white bg-indigo-500 hover:bg-indigo-600 rounded-full px-4 py-2 ml-2"><i class="fa-solid fa-share"></i></button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>

