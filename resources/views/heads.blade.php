<style>
@import url(https://pro.fontawesome.com/releases/v5.10.0/css/all.css);
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;800&display=swap');
body {
    font-family: 'Poppins', sans-serif;
}
.hover\:w-full:hover {
    width: 100%;
}
.group:hover .group-hover\:w-full {
    width: 100%;
}
.group:hover .group-hover\:inline-block {
    display: inline-block;
}
.group:hover .group-hover\:flex-grow {
    flex-grow: 1;
}
</style>

@php
    $params = array_filter(request()->all(), function($key) {
        return $key === 'page';
    }, ARRAY_FILTER_USE_KEY);
@endphp
<x-app-layout>
    <div class="h-screen flex flex-col mx-auto">
        <div class="-mb-4">
            @include('layouts.navigation')
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-end">
            <div class="relative inline-block text-left py-2">
                <button id="setting" 
                    class="inline-flex items-center px-4 py-2 bg-gray-100 border border-transparent border-gray-500 rounded-md font-semibold text-xs text-gray-500 uppercase tracking-widest hover:bg-gray-200 focus:bg-gray-700 active:bg-gray-900 focus:text-white focus:outline-none focus:ring-2 focus:ring-gray-700 focus:ring-offset-2 transition ease-in-out duration-150 mr-4">
                    Sort by
                </button>
                <div id="dropdown-content" class="hidden absolute right-0 mt-2 w-52 bg-white border border-gray-300 rounded-lg shadow-lg p-2">
                    <x-sort-selector :title="'User Name'" :route="'heads'" :sort="'user_name'" :$params/>
                    <x-sort-selector :title="'Email'" :route="'heads'" :sort="'email'" :$params/>
                    <x-sort-selector :title="'Created at'" :route="'heads'" :sort="'created_at'" :$params/>
                </div>
            </div>
            </div>
        </div>                

        <x-head-index :$heads/>   
    </div>
</x-app-layout>
<script> 
    const button = document.getElementById('setting');
    const dropdown = document.getElementById('dropdown-content');
    
    button.addEventListener('click', function () {
    dropdown.classList.toggle('hidden');
    });    
</script>
