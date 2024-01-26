<x-app-layout>
    <div class="flex-1 h-screen overflow-y-auto">
        @include('layouts.navigation')
        <div class="w-full max-w-[50%] mx-auto my-4 bg-white p-8 rounded-md shadow-md">
            <form id="createNoteForm"
                action="{{ route('update', $note) }}"
                enctype="multipart/form-data"
                method="POST">
                @csrf
                @method('PUT')

                <h1 class= "text-2xl font-bold mb-6 text-center">Update note</h1>
                @if (!is_null($note->parent))
                    <p class= "text-2xl mb-2 ps-9 text-start">this note added to:</p>
                    <div class="mb-6">
                        <x-note-body :note="$note->parent" />
                        <input type="hidden" id="parent_id" name="parent_id" value="{{ $note->parent->id }}">
                    </div>
                @endif

                <x-note-input :errors="$errors" :content="$note->content"  />

                <div class="flex justify-center">
                    <div class="files-wrapper mb-4 w-1/2">
                        <x-note-files-box :note="$note" addedClasses="w-full" :crashed=true direction="col"/>
                    </div>
                </div>
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
