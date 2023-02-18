<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

final class LoginController extends Controller
{
    public function index()
    {
        return view('user.auth.login');
    }

    // TODO: Логин у каждого типа одинаковый, вынеси отдельно
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
            ->route('user.main');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()
            ->route('user.main');
    }
}
