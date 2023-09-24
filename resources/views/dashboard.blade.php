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
                    <a href="{{route('page_access_token')}}">Get Page Access</a>
                    <br>
                    <a href="{{route('page_post')}}">Post Coupon Group</a>
                    <br>
                    <a href="{{route('page_post_it_self')}}">page post coupon</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
