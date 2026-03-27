<form method="POST" action="{{ route('login') }}" id="login-form" class="space-y-6">
    @csrf
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
                class="w-full pr-4 pl-11 py-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-colors"
            >
            <x-eva-email-outline class="w-4 h-4 absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400" />
        </div>
    </div>

    <x-inputs.input-password />

    <div id="remember-forgot" class="flex items-center justify-between">
        <label class="flex items-center">
            <input type="checkbox" class="w-4 h-4 text-primary border-gray-300 rounded focus:ring-indigo-500">
            <span class="ml-2 text-sm text-gray-600">Remember me</span>
        </label>

        <span class="text-sm text-indigo-500 hover:text-purple-500 font-medium cursor-pointer">
            Forgot password?
        </span>
    </div>

    <button
        type="submit"
        id="login-btn"
        class="w-full bg-gradient-to-r from-indigo-500 to-purple-500 text-white py-3 px-4 rounded-md font-medium hover:opacity-90 transition-opacity focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 cursor-pointer"
    >
        Sign in
    </button>
    <a
        id="registerLink"
        href="{{ route('register.form') }}"
        class="w-full flex justify-center bg-gradient-to-r from-indigo-500 to-purple-500 text-white py-3 px-4 rounded-md font-medium hover:opacity-90 transition-opacity focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 cursor-pointer"
    >
        Register
    </a>
</form>
