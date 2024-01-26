<div id="mote-input" class="mb-4 w-full bg-gray-50 rounded-lg border border-gray-300 dark:bg-gray-700 dark:border-gray-600">
    <div class="flex justify-between items-center py-2 px-3 border-b dark:border-gray-600">
        <div class="flex flex-wrap items-center divide-gray-300 sm:divide-x dark:divide-gray-600">
            <div class="flex items-center space-x-1 sm:pr-4">
                <button type="button" id="italic" class="p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
                    <p title="Make italic"><i class="fa fa-italic text-xs" aria-hidden="true"></i></p>
                </button>
                <button type="button" id="strong" class="p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
                    <p title="Make strong"><i class="fa fa-bold text-xs" aria-hidden="true"></i></p>
                </button>
                <button type="button" id="code" class="p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
                    <p title="Make code"><i class="fa fa-code text-xs" aria-hidden="true"></i></p>
                </button>
                <button type="button" id="link" class="p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
                    <p title="Make link"><i class="fa fa-link text-xs" aria-hidden="true"></i></p>
                </button>
            </div>
            <div class="flex items-center space-x-1 sm:pr-4">
                <label type="button" id="attach" class="p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
                    <input class="hidden" type="file" id="files" name="files[]" multiple>    
                    <p title="Attach"><i class="fa fa-paperclip text-xs" aria-hidden="true"></i></p>
                    <x-input-error :messages="$errors->get('files')" class="mt-2" />
                </label>
            </div>
        </div>
    </div>
    <div class="py-2 px-4 bg-white rounded-b-lg dark:bg-gray-800">
        <label for="content" class="sr-only">Enter note</label>
        <textarea id="content" 
            name="content"
            rows="8"
            class="block px-0 w-full text-sm text-gray-800 bg-white border-0 dark:bg-gray-800 focus:ring-0 dark:text-white dark:placeholder-gray-400"
            placeholder="Write an note..."
            required>{{ $content }}</textarea>
        <x-input-error :messages="$errors->get('content')" class="mt-2" />
    </div>

</div>
<div class="flex justify-center">
    <div class="files-wrapper mb-4 w-1/2">
    </div>
</div>
