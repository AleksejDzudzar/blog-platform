<?php

namespace App\Services;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function register(RegisterRequest $request): void
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'avatar' => 'default.jpg',
        ]);
        Auth::login($user);
    }

    public function login(LoginRequest $request): bool
    {
        return Auth::attempt($request->only('email', 'password'));
    }

    public function updateProfile(UpdateRequest $request, User $user): void
    {
        $user->name = $request->name;
        $user->email = $request->email;
        $user->facebook = $request->facebook;
        $user->twitter = $request->twitter;
        $user->linkedin = $request->linkedin;
        $user->instagram = $request->instagram;

        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $avatarPath;
        }
        $user->save();
    }

    public function logout(): void
    {
        Auth::logout();
    }
}
