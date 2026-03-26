<header id="header" class="bg-white border-b border-gray-200 sticky top-0 z-50">
    <nav class="max-w-7xl mx-auto px-5 py-4">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-2">
                <div class="w-8 h-8 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-lg flex items-center justify-center">
                    <x-eva-download-outline class="w-5 h-5 text-white"/>
                </div>
                <div class="text-xl font-semibold text-gray-900">MediaFetch</div>
            </div>
            <div class="hidden md:flex items-center space-x-8">
                <span class="text-gray-600 hover:text-indigo-500 transition-colors cursor-pointer">
                    Features
                </span>
                <span class="text-gray-600 hover:text-indigo-500 transition-colors cursor-pointer">
                    Pricing
                </span>
                <span class="text-gray-600 hover:text-indigo-500 transition-colors cursor-pointer">
                    Contact
                </span>
                <a href="{{ route("download") }}" class="flex items-center bg-indigo-500 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition-colors">
                    Get Started
                </a>
            </div>
        </div>
    </nav>
</header>
