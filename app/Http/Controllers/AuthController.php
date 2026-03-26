<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\RegisterFormRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegister() {
        return view("auth/register");
    }

    public function register(RegisterFormRequest $request)
    {
        $user = User::create([
            "name" => $request->validated("name"),
            "email" => $request->validated("email"),
            "password" => Hash::make($request->validated("password"))
        ]);

        Auth::login($user);

        return redirect()->route("download")->with("success", "Conta criada com sucesso");
    }

    public function showLogin() {
        return view("auth/login");
    }

    public function login(Request $request)
    {
        $credentials = $request->only("email", "password");

        if(Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended("/download");
        }

        return back()->withErrors([
            "email" => "As credencias fornecidas não foram encontradas"
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect("/");
    }
}
