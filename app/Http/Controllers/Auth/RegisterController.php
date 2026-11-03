<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function registerForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $user = User::create([
            'login' => $request->login,
            'password' => Hash::make($request->password),
        ]);

        auth()->login($user);

        return redirect()->route('admin.wishes');
    }
}
