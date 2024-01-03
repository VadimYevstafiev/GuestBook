<x-app-layout>
    <div class="h-screen flex flex-col mx-auto">
        @if (Route::has('login'))
            @auth
                <div>
                    @include('layouts.navigation')
                </div>                
            @else
                <div class="bg-white border-b border-gray-100 p-4">
                    <div class="max-w-7xl flex items-center justify-end">
                        <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                        @endif
                    </div>
                </div>
            @endauth
        @endif

        <x-note-index :$items />     
    </div>
</x-app-layout>
