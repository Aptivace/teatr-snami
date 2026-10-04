<?php

namespace App\Http\Controllers;

use App\Models\Afisha;
use App\Models\User;
use Illuminate\Http\Request;
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
        $validator = validator()->make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);


        if ($validator->fails()) return back()->withErrors($validator->errors())->withInput();

        if (auth()->attempt($validator->validated())) return back()->withErrors(["error" => "Неверный логин или пароль"]);

        if (auth()->user()->role !== "admin") return back()->withErrors(['error' => 'Не админ']);

        return back();
    }

}
