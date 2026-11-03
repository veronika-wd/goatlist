<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class LoginController extends Controller
{
    public function loginForm(): View
    {
        return view('login');
    }

    public function login(Request $request)
    {
        auth()->attempt([
            'login' => $request->login,
            'password' => $request->password
        ]);

        return redirect()->route('admin.wishes');
    }

    public function logout(){
        auth()->logout();
        return redirect()->route('login');
    }
}
