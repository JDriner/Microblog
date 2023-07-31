<link rel="stylesheet" href="https://unpkg.com/@themesberg/flowbite@1.2.0/dist/flowbite.min.css" />


<!-- This is an example component -->
<div class="max-w-2xl mx-auto">
    <div class="tab-buttons border-b border-gray-200 dark:border-gray-700 mb-4">
        <ul class="flex flex-wrap -mb-px" id="myTab" data-tabs-toggle="#followTabContent" role="tablist">
            <li class="mr-2" role="presentation">
                <button route="/follows/all"
                    class="inline-block text-gray-500 hover:text-gray-600 hover:border-gray-300 rounded-t-lg py-4 px-4 text-sm font-medium text-center border-transparent border-b-2 dark:text-gray-400 dark:hover:text-gray-300 {{ request()->is('follows/all') ? 'active' : '' }}"
                    id="all-tab" data-tabs-target="#all" type="button" role="tab" aria-controls="all"
                    aria-selected="true">All</button>
            </li>
            <li class="mr-2" role="presentation">
                <button route="/follows/followers"
                    class="inline-block text-gray-500 hover:text-gray-600 hover:border-gray-300 rounded-t-lg py-4 px-4 text-sm font-medium text-center border-transparent border-b-2 dark:text-gray-400 dark:hover:text-gray-300 {{ request()->is('follows/followers') ? 'active' : '' }}"
                    id="follower-tab" data-tabs-target="#follower" type="button" role="tab"
                    aria-controls="follower" aria-selected="false">Followers</button>
            </li>
            <li class="mr-2" role="presentation">
                <button route="/follows/following"
                    class="inline-block text-gray-500 hover:text-gray-600 hover:border-gray-300 rounded-t-lg py-4 px-4 text-sm font-medium text-center border-transparent border-b-2 dark:text-gray-400 dark:hover:text-gray-300 {{ request()->is('follows/following') ? 'active' : '' }}"
                    id="following-tab" data-tabs-target="#following" type="button" role="tab"
                    aria-controls="following" aria-selected="false">Following</button>
            </li>
            <li role="presentation">
                <button route="/follows/suggested"
                    class="inline-block text-gray-500 hover:text-gray-600 hover:border-gray-300 rounded-t-lg py-4 px-4 text-sm font-medium text-center border-transparent border-b-2 dark:text-gray-400 dark:hover:text-gray-300 {{ request()->is('follows/suggested') ? 'active' : '' }}"
                    id="suggested-tab" data-tabs-target="#suggested" type="button" role="tab"
                    aria-controls="suggested" aria-selected="false">Suggested</button>
            </li>
        </ul>
    </div>

    <div id="followTabContent">
        <div class="p-4 {{ request()->is('follows/all') ? '' : 'hidden' }}" id="all" role="tabpanel"
            aria-labelledby="all-tab">

            @if ($followers->isEmpty() && $following->isEmpty() && $suggestedUsers->isEmpty())
                <h1 class="text-gray-500 dark:text-gray-400 text-lg">No results found.</h1>
            @endif

            @if (!$followers->isEmpty())
                <p class="text-gray-500 dark:text-gray-400 text-sm">Followers</p>
                @foreach ($followers as $user)
                    @include('home.search.user-result')
                @endforeach
            @endif

            @if (!$following->isEmpty())
                <p class="text-gray-500 dark:text-gray-400 text-sm mt-2">Following</p>
                @foreach ($following as $user)
                    @include('home.search.user-result')
                @endforeach
            @endif

            @if (!$suggestedUsers->isEmpty())
                <p class="text-gray-500 dark:text-gray-400 text-sm mt-2">Suggested Users</p>
                @foreach ($suggestedUsers as $user)
                    @include('home.search.user-result')
                @endforeach
            @endif
        </div>

        <div class="p-4 {{ request()->is('follows/followers') ? '' : 'hidden' }}" id="follower" role="tabpanel"
            aria-labelledby="follower-tab">

            @if ($followers->isEmpty())
                <h1 class="text-gray-500 dark:text-gray-400 text-lg">You don't have any followers yet.</h1>
            @endif

            @foreach ($followers as $user)
                @include('home.search.user-result')
            @endforeach
        </div>

        <div class="p-4 {{ request()->is('follows/following') ? '' : 'hidden' }}" id="following" role="tabpanel"
            aria-labelledby="following-tab">

            @if ($following->isEmpty())
                <h1 class="text-gray-500 dark:text-gray-400 text-lg">You are not following anybody yet.</h1>
            @endif

            @foreach ($following as $user)
                @include('home.search.user-result')
            @endforeach
        </div>

        <div class="p-4 {{ request()->is('follows/suggested') ? '' : 'hidden' }}" id="suggested" role="tabpanel"
            aria-labelledby="suggested-tab">
            @if ($suggestedUsers->isEmpty())
                <h1 class="text-gray-500 dark:text-gray-400 text-lg">There are no suggested users as of now.</h1>
            @endif

            @foreach ($suggestedUsers as $user)
                @include('home.search.user-result')
            @endforeach
        </div>
    </div>
</div>

<script>
    $(function() {
        // Update the content of the tab when clicked
        $('.tab-buttons').find("button").click(function(e) {
            e.preventDefault();
            let route = $(this).attr('route');
            history.pushState(null, '', route);
            $('#page-content').load(route);
        });
    });
</script>
