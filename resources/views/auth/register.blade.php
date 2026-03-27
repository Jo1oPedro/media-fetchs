@extends("layouts.app")

@section("title", "Login")

@section("content")
    <div id="login-container" class="flex items-center justify-center min-h-screen p-5">
        <div id="login-card" class="bg-white rounded-lg shadow-lg border border-gray-200 w-full max-w-md p-8">
            <x-auth.login.logo-section />

            <x-auth.register.register-form/>
        </div>
    </div>
@endsection
