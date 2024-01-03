<div class="w-full px-4 py-2 flex justify-between">
    <div class="flex-1 flex items-center">
        <div>
            {{ $title }}
        </div>
    </div>

    <div class="px-1 bg-gray-100 shadow-lg rounded-2xl text-slate-500">
        <div class="flex-col">
            <div class="flex-auto hover:w-full group">
                <a href="{{ route($route, $params[0]) }}" class="flex items-center justify-center text-center mx-auto px-1 group-hover:w-full">
                    <span class="block px-1 py-1 text-xs group-hover:bg-indigo-100 rounded-full group-hover:flex-grow">
                        <i class="fa fa-arrow-up text-xs"></i><span class="hidden text-xs group-hover:inline-block ml-3 align-bottom">ASK</span>
                    </span>
                </a>
            </div>
            <div class="flex-auto hover:w-full group">
                <a href="{{ route($route, $params[1]) }}" class="flex items-center justify-center text-center mx-auto px-1 group-hover:w-full">
                    <span class="block px-1 py-1 text-xs group-hover:bg-indigo-100 rounded-full group-hover:flex-grow">
                        <i class="fa fa-arrow-down text-xs"></i><span class="hidden group-hover:inline-block ml-3 align-bottom">DESK</span>
                    </span>
                </a>
            </div>
        </div>
    </div>
</div>