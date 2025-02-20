<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }
    public function login(Request $request)
    {
        try {
            $credentials = $request->only('email', 'password');

            if (!Auth::guard('admin')->attempt($credentials))
                throw new \Exception(__('Girdiğiniz bilgiler ile eşleşen hesap bulunamadı.'));

            $request->session()->regenerate();

            return response()->json();

        } catch (\Throwable $exception) {
            throw ValidationException::withMessages([$exception->getMessage()]);
        }
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

}
