@section('title')
    Clarity Journal - {{ Auth::user()->first_name }}
@endsection

<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <a dir="ltr" type="button" href="{{ route('profile.view') }}"
                class=" bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded-s-lg mr-4">
                <i class="fa-solid fa-arrow-left"></i>
            </a>

            <h2 class="ml-2 font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Editing Profile') }}
            </h2>
        </div>
    </x-slot>
    
    {{-- Flash messages --}}
    @include('flash.flash') 

    <div class="pb-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
