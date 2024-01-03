<div>
    <div class="flex w-full pb-2">
        <div class="w-9 h-9 rounded-full flex items-center justify-center mr-2">
            <img src="https://placehold.co/200x/ffa8e4/ffffff.svg?text=ʕ•́ᴥ•̀ʔ&font=Lato" alt="User Avatar" class="w-8 h-8 rounded-full">
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
</div>
