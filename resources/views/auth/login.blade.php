@extends("layouts.app")

@section("title", "Login")

@section("content")
    <div id="login-container" class="flex items-center justify-center min-h-screen p-5">
        <div id="login-card" class="bg-white rounded-lg shadow-lg border border-gray-200 w-full max-w-md p-8">
            <x-auth.login.logo-section />

            <x-auth.login.login-form />

            <div id="divider" class="relative my-6">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-300"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-2 bg-white text-gray-500">
                        Or continue with
                    </span>
                </div>
            </div>

            <div id="social-login" class="space-y-3">
                <button class="w-full flex items-center justify-center px-4 py-3 border border-gray-300 rounded-md hover:bg-gray-50 transition-colors cursor-pointer">
                    <x-bi-google class="h-4 w-4 text-red-500 mr-3"/>
                    <span class="text-gray-700 font-medium">Continue with Google</span>
                </button>
                <a href="{{route("discord.oauth")}}" class="inline-flex w-full flex items-center justify-center px-4 py-3 border border-gray-300 rounded-md hover:bg-gray-50 transition-colors cursor-pointer">
                    <x-bi-discord class="h-4 w-4 text-indigo-500 mr-3"/>
                    <span class="text-gray-700 font-medium">Continue with Discord</span>
                </a>
            </div>
        </div>
    </div>
@endsection
