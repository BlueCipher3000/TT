<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('username', $request->username)->first();

        if (!$user || $request->password !== $user->password) {
            return back()->with('error', 'Tên đăng nhập hoặc mật khẩu không chính xác');
        }

        Auth::login($user);

        return redirect()->route('admin.quantri');

    }

    public function logout(Request $request)
    {
        Auth::logout(); // Logs out the user

        $request->session()->invalidate(); // Invalidates the session
        $request->session()->regenerateToken(); // Prevents CSRF attacks

        return redirect()->route('login.index'); // Redirect to login page
    }
}
