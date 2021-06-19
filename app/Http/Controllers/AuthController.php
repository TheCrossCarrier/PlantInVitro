<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Show the login form.
     * 
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        return view('login');
    }

    /**
     * Authenticate user.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function authenticate(Request $request)
    {
        $validatedRequest = $request->validate([
            'username' => 'required|string|min:6|max:20',
            'password' => 'required|string|min:8|max:255',
        ]);

        $remember = $request->input('remember_token') ? true : false;

        if (Auth::attempt($validatedRequest, $remember)) {
            $request->session()->regenerate();

            return redirect()
                ->intended()
                ->with('logged_in', 'Вы успешно вошли в систему.');
        }

        return back()
            ->withInput()
            ->withErrors([
                'username' => 'Неверный логин или пароль.',
                'password' => 'Неверный логин или пароль.',
            ]);
    }

    /**
     * Logout current user.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    /**
     * Show the registration form.
     * 
     * @return \Illuminate\Http\Response
     */
    public function registration()
    {
        return view('registration');
    }

    /**
     * Store registered user.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validatedRequest = $request->validate([
            'username' => 'required|string|min:6|max:20|unique:users',
            'password' => 'required|string|min:8|max:255|confirmed',
            'password_confirmation' => 'required',
        ]);

        if (User::create($validatedRequest)) {
            return back()->withSuccess('Вы успешно зарегистрированы.');
        }

        return abort(500, 'Не удалось зарегистрироваться.');
    }
}
