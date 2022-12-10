<?php

namespace App\Http\Controllers;

use App\Models\AdminData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\Paginator;

class Admin extends Controller
{
    public function adminLogin(Request $request)
    {
        $email = $request->input('email');
        $username = AdminData::where('email', $email)->pluck('username')->first();
        $role = AdminData::where('email', $email)->pluck('role')->first();
        $user_data = array(
            'email' => $request->get('email'),
            'password' => $request->get('password'),
        );

        if (Auth::attempt($user_data)) {
            $request->session()->put('user', ['username'=>$username, 'role'=>$role]);
            return redirect('admin/dashboard');
        } else {
            $msg = "Invalid Information";
            $request->session()->flash('invalidinfomsg', $msg);
            return redirect('admin/login');
        }
    }
}
