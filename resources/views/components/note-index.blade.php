<div class="flex-1 bg-gray-200 overflow-y-auto p-4 m-4">
    <div class="flex flex-col space-y-2">
        @foreach($items as $item)
            <div class="flex cursor-pointer bg-white rounded-lg p-3 gap-3 grid grid-cols-1" style="margin-left: {{ $item['deep'] * config('custom.notes.index.left_step') }}rem;">
                <x-note-body :note="$item['note']" />
                <x-note-buttons :note="$item['note']" />
            </div>
        @endforeach
    </div>
</div>

<div >
    <div class="px-4">
        {{ $items->links() }}
    </div>
    <div class="bg-white mt-4 border-t border-gray-300 p-4">
        <div class="flex items-center justify-end">
            <a href="{{ route('create') }}" 
                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-700 focus:ring-offset-2 transition ease-in-out duration-150 mr-4">
                Send note
            </a>
        </div>
    </div>
</div>        
