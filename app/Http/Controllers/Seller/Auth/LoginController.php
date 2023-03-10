<?php

namespace App\Http\Controllers\Seller\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Seller\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

final class LoginController extends Controller
{
    public function index()
    {
        return view('seller.auth.login');
    }

    public function store(LoginRequest $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $user = User::query()->where('email', '=', $email)->get()->first();

        if (!Hash::check($password, $user->password)) {
            return back()->withErrors(['Пароль или email неправильный']);
        }

        Auth::login($user, true);

        return redirect()
            ->route('seller.main');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()
            ->route('seller.main');
    }
}
