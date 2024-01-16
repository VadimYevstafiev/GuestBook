<div class="flex w-full ps-9 text-gray-700">
   @foreach($files as $file)
        <div class="m-2">
            <img src="{{ $file->url }}" class="h-32 ">
        </div>
   @endforeach
</div>