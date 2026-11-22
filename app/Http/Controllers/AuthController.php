<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function loginProcess(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        $user = User::where('username', $username)->first();

        if ($user && password_verify($password, $user->password)) {

            session([
                'id' => $user->id,
                'username' => $user->username,
                'full_name' => $user->full_name,
                'isLoggedIn' => true
            ]);

            return redirect('/');
        }

        return redirect('/login')
            ->with('error', 'Invalid username or password.');
    }

    public function logout()
    {
        session()->flush();

        return redirect('/login');
    }
}
