<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function show(){
        return view('admin.auth.login');
    }

    public function login(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $remember = $request->has('remember');

        $credentials = [
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ];

        if (Auth::attempt($credentials, $remember)){
            toastr()->success('Đăng nhập thành công');

            $user = Auth::user();
            if ($user->role == 'sale') return redirect(route('show-sale'));
            if ($user->role == 'censor') return redirect(route('show-censor'));
            return redirect(route('dashboard'));
        }
        toastr()->error('Username hoặc password không chính xác');
        return redirect(route('auth.login'));
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('auth.login');
    }
}
