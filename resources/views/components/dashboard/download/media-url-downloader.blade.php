<div id="url-input-section" class="bg-white rounded-lg border border-gray-200 p-6 mb-6">
    <h3 class="text-lg font-medium text-gray-900 mb-4">Enter Media URL</h3>
    <div id="download-form" class="flex flex-col md:flex-row gap-4">
        <div class="flex-1">
            <input
                type="url"
                placeholder="Paste your media URL here..."
                class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
            />
        </div>
        <button class="flex items-center w-fit space-x-2 px-6 py-3 bg-indigo-500 text-white rounded-lg hover:bg-indigo-500/90 font-medium cursor-pointer">
            <x-eva-download-outline class="w-4 h-4 text-white"/>
            <span>Download</span>
        </button>
    </div>
    <p class="text-xs text-gray-500 mt-2">
        Supported formats: MP4, MP3, JPG, PNG, GIF
    </p>
</div>

@push("scripts")
    @vite("resources/js/download/download-panel.js")
@endpush
