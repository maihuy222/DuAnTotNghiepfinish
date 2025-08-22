<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Flasher\Laravel\Facade\Flasher;

$hashed = '$2y$10$yKHYmkp4mszId8MdE3iUxeqKYxByEc1fqYY1hmuAhrY9yYo2c2mWy';


class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.auth.login'); // tạo file view riêng
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ], [
            'email.required' => 'Bạn cần nhập email',
            'email.email' => 'Email không đúng định dạng',
            'password.required' => 'Bạn cần nhập mật khẩu',
        ]);


        $admin = DB::table('employees')->where('email', $request->email)->first();

        if ($admin && Hash::check($request->password, $admin->password) && $admin->role === 'admin') {
            session(['admin' => $admin]);
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['email' => 'Email hoặc mật khẩu không chính xác.']);
    }

    public function logout()
    {
        session()->forget('admin');
        return redirect()->route('admin.login');
    }
}