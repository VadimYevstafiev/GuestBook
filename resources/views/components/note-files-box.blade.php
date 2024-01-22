<div class="flex flex-{{ $direction }} w-full">
   @foreach($files as $file)
        <x-dynamic-component :component="$file['type']" :model="$file['model']" :$addedClasses :$crashed />
   @endforeach
</div>