<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function view_login()
    {
        return view('auth.login');
    }

    public function view_register()
    {
        return view('auth.register');
    }

    public function view_profile()
    {
        return view('auth.profile');
    }

    public function upload_profile(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|image',
        ]);

        $user = Auth::user();

        $file = $request->file('file');
        $target_upload = 'profiles';
        $filename = Str::uuid() . "." . $file->getClientOriginalExtension();
        $file->move($target_upload, $filename);

        if ($user->picture) {
            File::delete($target_upload.'/'.$user->picture);
        }

        $user->picture = $filename;
        $user->save();

        $request->session()->flash('success', 'Berhasil ubah gambar.');
        return redirect()->route('profile');
    }

    public function profile_process(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|min:3|max:50',
        ]);

        if ($request->password) {
            $request->validate([
                'password' => 'required|confirmed|min:6',
            ]);
            $user->password = Hash::make($request->password);
        }

        $user->name = $request->name;
        $user->save();

        $request->session()->flash('success', 'Ubah Profil Berhasil.');
        return redirect()->route('profile');
    }

    public function register_process(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:50',
            'email' => 'email|unique:users,email',
            'password' => 'required|confirmed|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $request->session()->flash('success', 'Register Berhasil. Akun Anda sudah Aktif silahkan Login menggunakan email dan password.');
        return redirect('login');
    }

    public function login_process(Request $request)
    {
        $data = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];

        if (Auth::attempt($data, $request->input('remember'))) {
            return redirect('/');
        } else {
            return redirect()->route('login')->withErrors(['msg' => 'Email atau Password Salah']);
        }
    }

    public function logout_process(Request $request)
    {
        Auth::logout();
        $request->session()->flash('success', 'Berhasil keluar akun.');
        return redirect()->route('login');
    }
}
