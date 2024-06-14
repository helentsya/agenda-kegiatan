<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    // Fungsi untuk memproses login
    public function doLogin(Request $request)
    {

        $username = $request['username'];
        $password = $request['password'];
        $isLoginSuccess = false;
        // Pengambilan Data Username dan Password dari database berdasarkan username
        $user = User::where('username',  $username)->first();
        if ($user != null) {
            // Cek Apakah password sesuai
            $isLoginSuccess = password_verify($password, $user->password);
            if ($isLoginSuccess) {
                if ($user->roles == "admin") {
                    // Jika berhasil buat session dan menuju ke halaman utama
                    $request->session()->put('user', $user->username);
                    return redirect()->route('home');
                } else {
                    $request->session()->put('user', $user->username);
                    return redirect('/');
                }
            } else {
                // Jika gagal tampilkan error
                Session::flash('error', 'Password Salah');
                return redirect()->back();
            }
        } else {
            // Jika gagal tampilkan error
            Session::flash('error', 'Username tidak ditemukan');
            return redirect()->back();
        }
    }

    // Fungsi untuk form login
    public function formLogin(Request $request)
    {
        if (session()->get('user') != null) return redirect()->route('home');
        return view('pages.login');
    }

    // Fungsi untuk memproses log out
    public function doLogout(Request $request)
    {
        $request->session()->forget('user');
        return redirect()->route('form-login');
    }
}
