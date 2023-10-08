<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
                <div class="p-6 text-gray-900">
                    <a href="{{ route('page_access_token') }}" class="text-blue-500 hover:underline">Get Page Access</a>
                    <br>
                    <a href="{{ route('page_post') }}" class="text-blue-500 hover:underline">Post Coupon Group</a>
                    <br>
                    <a href="{{ route('page_post_it_self') }}" class="text-blue-500 hover:underline">Page Post Coupon</a>
                    <br>
                    <a href="{{ route('shared_post') }}" class="text-blue-500 hover:underline">Shared Post</a>
                    <br>
                    <a href="{{ route('scrap') }}" class="text-blue-500 hover:underline">Scrap</a>
                    <br>
                    <a href="{{ route('cookies') }}" class="text-blue-500 hover:underline">Add Cookies</a>
                    <br>
                    <a href="{{ route('poster') }}" class="text-blue-500 hover:underline">Poster</a>
                    <br>
                    <a href="{{ route('reels') }}" class="text-blue-500 hover:underline">Reels</a>
                    <br>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
