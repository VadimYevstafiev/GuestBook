<div class="flex cursor-pointer bg-white rounded-lg p-3 gap-3 grid grid-cols-1" style="margin-left: {{ $marginLeft }}rem;">
    <div>
        <div class="flex w-full ">
            <div class="w-9 h-9 rounded-full flex items-center justify-center mr-2">
                <img src="https://placehold.co/200x/ffa8e4/ffffff.svg?text=ʕ•́ᴥ•̀ʔ&font=Lato" alt="User Avatar" class="w-8 h-8 rounded-full">
            </div>
            <h1 class="text-2xl font-semibold">{{ $userName }}</h1>
        </div>
        <div class="flex w-full ps-9">
            <p class="text-gray-700">{{ $content }}</p>
        </div>
    </div>
    <div class="flex items-center justify-end">
        <a href="#" 
            class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 mr-4">
            Add comment
        </a>
    </div>
</div> 



