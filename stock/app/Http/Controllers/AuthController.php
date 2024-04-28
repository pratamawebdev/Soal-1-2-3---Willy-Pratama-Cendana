<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login() {
        return view('components.auth.login');
    }

    public function register() {
        return view('components.auth.register');
    }

    public function postRegister(Request $request) {
        // Validasi data yang diterima dari formulir
        $request->validate([
            'nama_lengkap' => 'required|string|max:255|min:3',
            'no_hp'=>'required|numeric|min:8|regex:/^08[0-9]{6,13}$/',
            'email' => 'required|string|email|unique:users|max:255',
            'password' => 'required|string|min:8|confirmed|regex:/^\S.*\S$/',
        ],[
            'nama_lengkap.required' => 'Kolom nama lengkap harus diisi.',
            'nama_lengkap.string' => 'Kolom nama lengkap harus berupa teks.',
            'nama_lengkap.max' => 'Kolom nama lengkap tidak boleh lebih dari 255 karakter.',
            'nama_lengkap.min' => 'Kolom nama lengkap harus memiliki minimal 3 karakter.',
            'no_hp.required' => 'Kolom nomor HP harus diisi.',
            'no_hp.numeric' => 'Kolom nomor HP harus berupa angka.',
            'no_hp.min' => 'Kolom nomor HP harus memiliki minimal 8 digit.',
            'no_hp.regex' => 'Nomor HP harus diawali 08, minimal 8 digit dan maksimal 15 digit.',
            'email.required' => 'Kolom email harus diisi.',
            'email.string' => 'Kolom email harus berupa teks.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'email.max' => 'Kolom email tidak boleh lebih dari 255 karakter.',
            'password.required' => 'Kolom kata sandi harus diisi.',
            'password.string' => 'Kolom kata sandi harus berupa teks.',
            'password.min' => 'Kolom kata sandi harus memiliki minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
            'password.regex' => 'Password harus memiliki minimal 8 karakter dan tidak termasuk spasi di awal dan akhir.',
        ]);

        // Buat akun pengguna baru
        $user = new User();
        $user->nama_lengkap = $request->nama_lengkap;
        $user->email = $request->email;
        $user->no_hp = $request->no_hp;
        $user->password = Hash::make($request->password);
        $user->save();

        // Redirect pengguna setelah membuat akun
        return redirect()->route('login')->with('success', 'Akun berhasil dibuat! Silakan masuk.');
    }

    public function postLogin(Request $request) {
        // Lakukan validasi input
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ],[
            'email.required' => 'Kolom email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Kolom password harus diisi.',
            // 'password.exists' => 'Password yang dimasukkan salah.',
        ]);

        // Coba untuk mengautentikasi pengguna
        if (Auth::attempt($credentials)) {
            // Jika berhasil, redirect ke halaman yang diinginkan
            return redirect()->intended('/home');
        }

        // Jika tidak berhasil, kembali ke halaman login dengan pesan error
        return redirect()->back()->with('gagal','Pastikan email dan password benar');
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }

}
