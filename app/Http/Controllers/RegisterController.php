<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class RegisterController extends Controller
{
    public function index()
    {
        return view('register.index', [
            'title' => 'Daftar'
        ]);
    }

    public function store(Request $request)
    {
        $validated= $request->validate([
            'name' => ['required', 'max:255'],
            'username' => ['required', 'min:8', 'max:24', 'unique:users'],
            'email' => ['required', 'email:dns', 'unique:users'],
            'password' => ['required', 'min:8', 'max:255']
        ]);

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect('/login')->with('success', 'Pendaftaran akun berhasil! silahkan masuk');;
    }
}
