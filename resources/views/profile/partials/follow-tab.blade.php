<link rel="stylesheet" href="https://unpkg.com/@themesberg/flowbite@1.2.0/dist/flowbite.min.css" />


<!-- This is an example component -->
<div class="max-w-2xl mx-auto">

    <div class="border-b border-gray-200 dark:border-gray-700 mb-4">
        <ul class="flex flex-wrap -mb-px" id="myTab" data-tabs-toggle="#myTabContent" role="tablist">

            <li class="mr-2" role="presentation">
                <button
                    class="inline-block text-gray-500 hover:text-gray-600 hover:border-gray-300 rounded-t-lg py-4 px-4 text-sm font-medium text-center border-transparent border-b-2 dark:text-gray-400 dark:hover:text-gray-300 active"
                    id="all-tab" data-tabs-target="#all" type="button" role="tab" aria-controls="all"
                    aria-selected="true">All</button>
            </li>
            <li class="mr-2" role="presentation">
                <button
                    class="inline-block text-gray-500 hover:text-gray-600 hover:border-gray-300 rounded-t-lg py-4 px-4 text-sm font-medium text-center border-transparent border-b-2 dark:text-gray-400 dark:hover:text-gray-300"
                    id="follower-tab" data-tabs-target="#follower" type="button" role="tab"
                    aria-controls="follower" aria-selected="false">Followers</button>
            </li>
            <li class="mr-2" role="presentation">
                <button
                    class="inline-block text-gray-500 hover:text-gray-600 hover:border-gray-300 rounded-t-lg py-4 px-4 text-sm font-medium text-center border-transparent border-b-2 dark:text-gray-400 dark:hover:text-gray-300"
                    id="following-tab" data-tabs-target="#following" type="button" role="tab"
                    aria-controls="following" aria-selected="false">Following</button>
            </li>
            <li role="presentation">
                <button
                    class="inline-block text-gray-500 hover:text-gray-600 hover:border-gray-300 rounded-t-lg py-4 px-4 text-sm font-medium text-center border-transparent border-b-2 dark:text-gray-400 dark:hover:text-gray-300"
                    id="suggested-tab" data-tabs-target="#suggested" type="button" role="tab"
                    aria-controls="suggested" aria-selected="false">Suggested</button>
            </li>
        </ul>
    </div>
    <div id="myTabContent">
        <div class="p-4" id="all" role="tabpanel" aria-labelledby="all-tab">
            
            <p class="text-gray-500 dark:text-gray-400 text-sm">Followers</p>
                @foreach ($followers as $user)
                    @include('home.search.user-result')
                @endforeach

            <p class="text-gray-500 dark:text-gray-400 text-sm mt-2">Following</p>
                @foreach ($following as $user)
                    @include('home.search.user-result')
                @endforeach

            <p class="text-gray-500 dark:text-gray-400 text-sm mt-2">Suggested Users</p>
                @foreach ($suggestedUsers as $user)
                    @include('home.search.user-result')
                @endforeach
        </div>

        <div class="p-4 hidden" id="follower" role="tabpanel" aria-labelledby="follower-tab">
            @foreach ($followers as $user)
                @include('home.search.user-result')
            @endforeach
        </div>

        <div class="p-4 hidden" id="following" role="tabpanel" aria-labelledby="following-tab">
            @foreach ($following as $user)
                @include('home.search.user-result')
            @endforeach
        </div>

        <div class="p-4 hidden" id="suggested" role="tabpanel" aria-labelledby="suggested-tab">
            @foreach ($suggestedUsers as $user)
                @include('home.search.user-result')
            @endforeach
        </div>
    </div>
</div>

<script src="https://unpkg.com/@themesberg/flowbite@1.2.0/dist/flowbite.bundle.js"></script>
