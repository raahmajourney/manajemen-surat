<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Contracts\Service\Attribute\Required;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;


class AuthController extends Controller
{
    public function login(){
        return view('auth.login');
    }
    public function register(){
        return view('auth.register');
    }


    // Login
    public function loginProses(Request $request){
            $request->validate([
                'email'       => 'required',
                'password'    => 'required|min:8',
            ], [
                'email.required'     => 'Email Tidak Boleh Kosong',
                'password.required'  => 'Password Tidak Boleh Kosong',
                'password.min'       => 'Password Minimal 8 Karakter',
            ]);

             $credentials = $request->only('email', 'password');

          if (Auth::attempt($credentials)) {
                $request->session()->regenerate();

                if (Auth::user()->hasRole('admin')) {
                    return redirect()->route('dashboard');
                } elseif (Auth::user()->hasRole('dosen')) {
                    return redirect()->route('formulirsurat'); // Ubah ini sesuai nama rute formulir surat
                } elseif (Auth::user()->hasRole('staf')) {
                    return redirect()->route('dashboard'); // Opsional
                } else {
                    return redirect()->route('dashboard'); // fallback
                }
            }


        return back()->withErrors(['email' => 'Email atau password salah.'])->withInput();
    }


    // Register 
    public function registerProses(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'password.min'       => 'Password Minimal 8 Karakter',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole('user'); // default user

        return redirect()->route('login')->with('success', 'Akun berhasil dibuat.');
    }

    //logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Anda berhasil logout.');
    }


}
