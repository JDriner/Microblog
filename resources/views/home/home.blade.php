@section('title')
    Home
@endsection

<x-app-layout>
    <!-- Search Box -->
    <div class="flex justify-center mt-8">
        <div class="w-full max-w-lg">
            <form action="" method="GET">
                <div class="flex items-center bord rounded-full">
                    <input type="text" name="query" id="query" placeholder="Search for posts, users..."
                        class="px-4 py-2 w-full rounded-full focus:outline-none" />
                    <button type="submit"
                        class="text-white bg-indigo-500 hover:bg-indigo-600 rounded-full px-4 py-2 ml-2">Search</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Post Create -->
    @include('home.partials.create-post')

    <!-- Display Create -->
    @include('home.partials.post-content')

</x-app-layout>
