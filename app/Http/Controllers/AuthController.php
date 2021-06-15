<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        $urlPrevious = url()->previous();
        return view('login', compact('urlPrevious'));
    }

    public function auth(Request $request)
    {
        $validatedRequest = $request->validate([
            'username' => 'required|string|min:6|max:20',
            'password' => 'required|string|min:8|max:255',
        ]);

        $credentials = Arr::only($validatedRequest, ['username', 'password']);

        $remember = $request->input('remember_token') ? true : false;

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            return redirect()->intended()->with('logged_in', 'Вы успешно вошли в систему. ');
        }

        return back()
            ->withInput()
            ->withErrors([
                'username' => 'Неверный логин или пароль.',
                'password' => 'Неверный логин или пароль.',
            ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        # Очистка старой сессии
        $request->session()->invalidate();

        # Генерация гостевого токена сессии
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function registration()
    {
        return view('registration');
    }

    public function register(Request $request)
    {
        $validatedRequest = $request->validate([
            'username' => 'required|string|min:6|max:20|unique:users',
            'password' => 'required|string|min:8|max:255',
            'repeat_password' => 'required|string|same:password',
        ]);

        $credentials = Arr::only($validatedRequest, ['username', 'password']);

        if (User::create($credentials)) {
            return back()->withSuccess('Вы успешно зарегистрированы. ');
        };

        return back()->withInput();
    }
}
