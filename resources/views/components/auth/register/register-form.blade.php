<form method="POST" action="{{ route("register") }}" id="login-form" class="space-y-6">
    @csrf
    <div id="name-field">
        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
            Name
        </label>
        <div class="relative">
            <input
                placeholder="Enter your name"
                type="text"
                id="name"
                name="name"
                required
                value="{{ old('name') }}"
                class="w-full pr-4 pl-11 py-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-colors"
            >
            <x-bi-person-fill class="w-4 h-4 absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400" />
        </div>
        @error('name')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div id="email-field">
        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
            Email Address
        </label>
        <div class="relative">
            <input
                placeholder="Enter your email"
                type="email"
                id="email"
                name="email"
                required
                value="{{ old('email') }}"
                class="w-full pr-4 pl-11 py-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-colors"
            >
            <x-eva-email-outline class="w-4 h-4 absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400" />
        </div>
        @error('email')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <x-inputs.input-password />
    <x-inputs.input-password
        id="password-confirmation"
        label="Password confirmation"
        placeholder="Confirm your password"
        input-id="password-confirmation"
        input-name="password_confirmation"
        error-bag="password_confirmation"
    />

    <button
        type="submit"
        id="register-btn"
        class="w-full bg-gradient-to-r from-indigo-500 to-purple-500 text-white py-3 px-4 rounded-md font-medium hover:opacity-90 transition-opacity focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 cursor-pointer"
    >
        Register
    </button>
</form>
