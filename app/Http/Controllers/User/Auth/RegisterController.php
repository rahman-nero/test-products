<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

final class RegisterController extends Controller
{
    public function index()
    {
        return view('user.auth.register');
    }

    public function store(RegisterRequest $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');

        try {
            $user = User::query()->create([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make($password)
            ]);
            $user->assignRole('consumer');

        } catch (\Exception $e) {
            return back()->withErrors(['Произошла ошибка при регистрации, пожалуйста, повторите попытку позднее']);
        }

        return redirect()
            ->route('user.login');
    }
}
