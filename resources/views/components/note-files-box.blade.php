<div class="flex flex-{{ $direction }} w-full">
   @foreach($files as $file)
        <x-dynamic-component :component="$file['type']" :url="$file['url']" :$addedClasses :$crashed />
   @endforeach
</div>