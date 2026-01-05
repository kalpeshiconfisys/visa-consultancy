<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login(Request $request){

        if (Session::has('admin_id')) {
             return redirect('admin/dashboard');
        }
        return view('Admin.auth.login');
    }
    
    public function loginSubmit(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            $admin = Auth::guard('admin')->user();
            session(['admin_id' => $admin->id]);
            return redirect(url('admin/dashboard'))->with('success', 'Logging in successfully');
        } else {
            return redirect()->back()->with('error', 'Invalid credentials');
        }
    }

    public function logout(){
        session()->forget('admin_id');
        Auth::guard('admin')->logout();
        return redirect(url('admin/login'))->with('success', 'Logged out successfully');
    }

}

