<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
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
            File::delete($target_upload . '/' . $user->picture);
        }

        $user->picture = $filename;
        $user->save();

        $request->session()->flash('success', 'Berhasil ubah gambar.');
        return redirect()->route('profile');
    }

    public function profile_process(Request $request)
    {
        $user = Auth::user();

        $data = $request->all();
        $rules = [
            'name' => 'required|min:3|max:60',
            'username' => 'required|string|regex:/^[a-zA-Z0-9_]+$/|max:30|unique:users,username,'.$user->user_id.',user_id',
        ];
        $messages = [
            'name.required' => 'Form nama tidak boleh kosong.',
            'name.min' => 'Nama minimal 3 karakter',
            'name.max' => 'Nama minimal 60 karakter',
            'username.required' => 'Form username tidak boleh kosong.',
            'username.regex' => 'Format username yang dibolehkan: a-z, A-Z, 0-9, _',
            'username.unique' => 'Username ini telah dipakai.',
        ];
        Validator::make($data, $rules, $messages)->validate();

        if ($request->password) {
            $request->validate([
                'password' => 'required|confirmed|min:6',
            ]);
            $user->password = Hash::make($request->password);
        }

        $user->name = $request->name;
        $user->username = $request->username;
        $user->save();

        $request->session()->flash('success', 'Ubah Profil Berhasil.');
        return redirect()->route('profile');
    }

    public function register_process(Request $request)
    {
        $data = $request->all();
        $rules = [
            'name' => 'required|min:3|max:60',
            'email' => 'email|unique:users,email',
            'password' => 'required|confirmed|min:6',
        ];
        $messages = [
            'name.required' => 'Form nama tidak boleh kosong.',
            'name.min' => 'Nama minimal 3 karakter',
            'name.max' => 'Nama minimal 60 karakter',
            'email.required' => 'Form email tidak boleh kosong.',
            'email.unique' => 'Email ini telah dipakai.',
            'password.required' => 'Form password tidak boleh kosong.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'password.min' => 'Password minimal 6 karakter.',
        ];
        Validator::make($data, $rules, $messages)->validate();

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => 'user_'.Carbon::now()->timestamp,
            'password' => Hash::make($request->password),
        ]);

        $request->session()->flash('success', 'Register Berhasil. Akun Anda sudah Aktif silahkan Login menggunakan email dan password.');
        return redirect('login');
    }

    public function login_process(Request $request)
    {
        $usermail = $request->input('usermail');
        $password = $request->input('password');

        $field_type = filter_var($usermail, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $data = [
            $field_type => $usermail,
            'password' => $password
        ];

        if (Auth::attempt($data, $request->input('remember'))) {
            return redirect('/');
        } else {
            return redirect()->route('login')->withErrors(['msg' => 'Username/Email atau Password Salah']);
        }
    }

    public function logout_process(Request $request)
    {
        Auth::logout();
        $request->session()->flash('success', 'Berhasil keluar akun.');
        return redirect()->route('login');
    }
}
