<div class="flex-1 bg-gray-200 overflow-y-auto p-4 m-4">
    <div class="flex flex-col space-y-2">
        @foreach($notes as $note)
            <x-note-grid :note="$note" /> 
        @endforeach
    </div>
</div>

<div >
    <div class="px-4">
        {{ $notes->links() }}
    </div>
    <div class="bg-white mt-4 border-t border-gray-300 p-4">
        <div class="flex items-center justify-end">
            <a href="#" 
                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 mr-4">
                Send comment
            </a>
        </div>
    </div>
</div>        
