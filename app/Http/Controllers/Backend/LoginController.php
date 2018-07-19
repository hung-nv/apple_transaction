<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function getLogin() {
        if(!Auth::check()) {
            return view('backend.auth.login');
        } else {
            return redirect()->route('admin.dashboard');
        }
    }

    public function postLogin(Request $request) {
        $validator = \Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('login')
                ->withErrors($validator)
                ->withInput();
        } else {
            if(Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->back()->withErrors('Incorrect username or password');
            }
        }
    }
    public function getLogout() {
        Auth::logout();
        return redirect()->route('login');
    }
}
