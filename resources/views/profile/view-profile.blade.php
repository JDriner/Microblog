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
        <div class="w-2/3">
            <div class="pt-4">
                @include('profile.partials.my-posts')
            </div>
        </div>
    </div>
</x-app-layout>
