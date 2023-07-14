
<!-- Flash Messages-->
@if (session('status') && session('postId') == $post->id)
    <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md" role="alert">
        <div class="flex">
            <div class="py-1 fill-current h-6 w-6 text-teal-500 mr-4">
                <i class="fa-regular fa-circle-check"></i>
            </div>
            <div>
                <p class="font-bold">Success!</p>
                <p class="text-bold">{{ session('status') }}</p>
            </div>
        </div>
    </div>
@endif

@error('comment')
    <div role="alert">
        <div class="bg-red-500 text-white font-bold rounded-t px-4 py-2">
            Error
        </div>
        <div class="border border-t-0 border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700">
            <p>{{ $message }}</p>
        </div>
    </div>
@enderror