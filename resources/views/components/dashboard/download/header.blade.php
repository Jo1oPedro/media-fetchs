<header id="header" class="h-fit w-full bg-white border-b border-gray-200 px-6 py-4">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-xl font-semibold text-gray-900">Media Fetch</h2>
            <p class="text-sm text-gray-600">Download from social platforms</p>
        </div>
        <div class="relative flex items-center space-x-4">
            <button class="p-2 text-gray-400 hover:text-gray-600 rounded-lg">
                <x-bi-bell-fill class="w-4 h-4"/>
            </button>
            <button id="header-gear" class="p-2 text-gray-400 hover:text-gray-600 rounded-lg">
                <x-bi-gear-fill class="w-4 h-4"/>
            </button>
            <div id="header-options" class="absolute right-0 top-full hidden bg-gray-100">
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route("logout") }}" class="flex items-center space-x-3 px-4 py-3 text-gray-700 rounded-lg font-medium cursor-pointer hover:bg-indigo-500/10">
                            <span class="hidden md:block">Logout</span>
                            <x-ionicon-exit-outline class="w-4 h-4" />
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>

@once
    @push("scripts")
        <script>
            window.addEventListener("load", function () {
                $("#header-gear").on("click", function (dale) {
                    const headerOptions = $(this).siblings("#header-options");
                    headerOptions.toggleClass("hidden");
                });
            });
        </script>
    @endpush
@endonce
