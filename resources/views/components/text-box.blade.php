<div class="relative {{ $addedClasses}} p-2">
    <iframe src="{{ $url }}" class="{{ $addedClasses}} border border-gray-500"></iframe>
    @if ($crashed)
        <a href="#" 
            class="text_file-remove my-4 mx-4 py-1 px-1 border-red-500 bg-red-500 hover:bg-red-600 text-white rounded-lg"
            style="position: absolute; top: 0; right: 0"
            data-route="{{ route('ajax.text_files.delete', $model) }}"><i class="fa fa-trash" aria-hidden="true"></i></a>
    @endif
</div>