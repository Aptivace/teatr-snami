<?php

namespace App\Http\Controllers;

use App\Models\Afisha;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AdminController extends Controller
{
    //

    public function index()
    {
        if (!auth()->user() || auth()->user()->role !== 'admin') return view("admin-login");

        $afishes = Afisha::all();

        return view("admin-afisha", compact("afishes"));

    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $remember = $request->boolean("remember");

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->intended('/admin');
        }


        return back()->withErrors(['email' => 'Неверная почта или пароль'])->onlyInput('email', 'remember');
    }

    public function logout(Request $request)
    {
        // 1. Выход пользователя
        Auth::logout();

        // 2. Сброс текущей сессии (очищает все сессионные данные)
        $request->session()->invalidate();

        // 3. Генерация нового CSRF-токена для защиты от повторного использования
        $request->session()->regenerateToken();

        // 4. Редирект на главную страницу или страницу входа
        return redirect('/')->with('success', 'Вы успешно вышли из системы');
    }

}
