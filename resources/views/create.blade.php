<x-app-layout>
    <div class="flex-1 h-screen overflow-y-auto">
        @include('layouts.navigation')
        <div class="w-full max-w-[50%] mx-auto my-4 bg-white p-8 rounded-md shadow-md">
            <form id="createNoteForm"
                action="{{ route('store') }}"
                enctype="multipart/form-data"
                method="POST">
                @csrf

                @if (!is_null($parent))
                    <h1 class= "text-2xl font-bold mb-6 text-center">Add note to:</h1>
                    <div class="mb-4">
                        <x-note-body :note="$parent" />
                        <input type="hidden" id="parent_id" name="parent_id" value="{{ $parent->id }}">
                    </div>
                @else
                    <h1 class= "text-2xl font-bold mb-6 text-center">Create new note</h1>
                @endif

                <x-note-input :errors="$errors" />

                <x-google-recaptha :errors="$errors" />

                <div class="w-full flex items-center">
                    <button id="setting" action="submit"
                        class="w-full px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white text-center uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-700 focus:ring-offset-2 transition ease-in-out duration-150 mr-4">
                        Send
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
