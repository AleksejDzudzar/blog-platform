<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateRequest;
use App\Services\AuthService;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $request)
    {
        $this->authService->register($request);
        return redirect('/');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        if ($this->authService->login($request)) {
            return redirect('/');
        }
        return back()->withErrors(['Invalid credentials']);
    }

    public function editProfile()
    {
        return view('auth.profile', [
            'user' => auth()->user(),
        ]);
    }

    public function updateProfile(UpdateRequest $request)
    {
        $this->authService->updateProfile($request, auth()->user());
        return redirect()->route('profile.edit')->with('success', 'Profile successfully updated!');
    }

    public function logout()
    {
        $this->authService->logout();
        return redirect()->route('login')->with('success', 'You have been logged out.');
    }
}
