<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function showLoginForm()
    {
       /*  if (Auth::check() === true) {
            return redirect()->route('admin.admin.dashboard');
        } */
        return view('admin.index');
    }

    public function login(Request $request)
    {
        //dd($x = Hash::make('123456'));

        if (in_array('', $request->only('email', 'password'))) {
            return redirect()->back()->with([
                'color' => 'danger',
                'message' => 'Ooops, informe todos os campos para efetuar o login!'
            ]);
        }

        if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            return redirect()->back()->with([
                'color' => 'danger',
                'message' => 'Ooops, informe um email válido!'
            ]);
        }

        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];
        //

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // The user is active, not suspended, and exists.
            return redirect()->route('admin.admin.dashboard');
        } else {
            return redirect()->route('admin.admin.login')->with([
                'color' => 'danger',
                'message' => 'Ooops, Usuário ou Senha incorretos!'
            ]);
        }
    }

    public function logout()
    {
       //dd('logout adm');
        Auth::logout();
        return redirect()->route('admin.admin.login');
    }

}
