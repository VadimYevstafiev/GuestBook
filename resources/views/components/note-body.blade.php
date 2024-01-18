<div>
    <div class="flex w-full pb-2">
        <div class="rounded-full flex items-center justify-center mr-2">
            <img src="{{ $note->author->avatar->url }}" alt="User Avatar" class="w-16 h-16 rounded-full">
        </div>
        <div class="flex-col">
            <h1 class="text-2xl font-semibold">{{ $note->author->user_name }}</h1>
            <p class="text-gray-700">{{ $note->author->email }}</p>
        </div>
    </div>
    <div class="flex-col w-full ps-9 text-gray-700">
        <p>{{ $note->content }}</p>
        <p class="pt-2 italic">{{ 'Created at ' . $note->created_at }}</p>
    </div>
    <div class="h-32 ps-9">
        <x-note-files-box :$note addedClasses="h-32" :crashed=false direction="row"/>
    </div>
</div>
