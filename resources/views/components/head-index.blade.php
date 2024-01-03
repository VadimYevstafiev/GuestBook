<div class="flex-1 bg-gray-200 overflow-y-auto p-4 m-4">
    <div class="flex flex-col space-y-2">
        @foreach ($heads as $head)
            <div class="flex cursor-pointer bg-white rounded-lg p-3 gap-3 grid grid-cols-1">
                <x-note-body :note="$head" />
            </div>
        @endforeach
    </div>
</div>

<div >
    <div class="px-4">
        {{ $heads->links() }}
    </div>
</div> 
