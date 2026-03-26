<div id="{{ $id }}">
    @if($showLabel)
        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
            {{ $label }}
        </label>
    @endif
    <div class="relative">
        <input
            placeholder="{{ $inputPlaceholder }}"
            type="password"
            id="{{ $inputId }}"
            name="{{ $inputName }}"
            required
            class="w-full pl-11 pr-11 py-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-colors"
        >
        <x-bi-lock-fill class="w-4 h-4 absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400" />
        <button type="button" class="toggle-password cursor-pointer absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
            <x-fas-eye class="eye-password w-4 h-4 text-gray-400"/>
            <x-heroicon-s-eye-slash class="eye-slash-password w-4 h-4 text-gray-400 hidden"/>
        </button>
    </div>
    @error($errorBag)
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

@once
    @push("scripts")
        <script>
            window.addEventListener("load", function () {
                $(document).on("click", ".toggle-password", function () {
                    let input = $(this).siblings("input");

                    if(input.attr("type") === "password") {
                        input.attr("type", "text");
                        $(this).find(".eye-password").addClass("hidden");
                        $(this).find(".eye-slash-password").removeClass("hidden");
                    } else {
                        input.attr("type", "password");
                        $(this).find(".eye-password").removeClass("hidden");
                        $(this).find(".eye-slash-password").addClass("hidden");
                    }
                });
            });
        </script>
    @endpush
@endonce
