<aside id="sidebar" class="min-h-screen w-fit md:w-64 bg-white border-r border-gray-200 flex flex-col">
    <div id="sidebar-header" class="p-5 border-b border-gray-200">
        <div class="flex items-center space-x-3">
            <div class="w-8 h-8 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-lg flex items-center justify-center">
                <x-eva-download-outline class="w-5 h-5 text-white"/>
            </div>
            <h1 class="hidden md:block font-semibold text-gray-900">MediaFetch</h1>
        </div>
    </div>
    <nav id="sidebar-nav" class="flex-1 p-4">
        <ul class="space-y-2">
            <li>
                <span
                    class="flex items-center space-x-3 px-4 py-3 rounded-lg font-medium cursor-pointer hover:bg-indigo-500/10 {{ request()->routeIs("download") ? 'text-indigo-500 bg-indigo-500/10' : 'text-gray-700' }}"
                    id="nav-download"
                >
                    <x-eva-download-outline class="w-5 h-5" />
                    <span class="hidden md:block">Download</span>
                </span>
            </li>
            <li>
                <span class="flex items-center space-x-3 px-4 py-3 text-gray-700 rounded-lg font-medium cursor-pointer hover:bg-indigo-500/10" id="nav-my-download">
                    <x-fas-folder-open class="w-5 h-5" />
                    <span class="hidden md:block">My Downloads</span>
                </span>
            </li>
            <li>
                <span class="flex items-center space-x-3 px-4 py-3 text-gray-700 rounded-lg font-medium cursor-pointer hover:bg-indigo-500/10" id="nav-download-queue">
                    <x-zondicon-list class="w-5 h-5" />
                    <span class="hidden md:block">Download Queue</span>
                </span>
            </li>
            <li>
                <span class="flex items-center space-x-3 px-4 py-3 text-gray-700 rounded-lg font-medium cursor-pointer hover:bg-indigo-500/10" id="nav-profile">
                    <x-heroicon-s-user class="w-5 h-5" />
                    <span class="hidden md:block">Profile</span>
                </span>
            </li>
        </ul>
    </nav>
</aside>
