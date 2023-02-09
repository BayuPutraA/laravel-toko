<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

use App\Models\Staff;

class AuthController extends Controller
{
    public function login(){
        if(Session::has('logged')){
            if(Session::get('logged') == 'staff') return redirect('/dashboard');
            else return redirect('/market');

        }else{
            return view('login');
        }
    }

    public function authenticate(Request $request){
        $username = $request->input('username');
        $password = $request->input('password');

        if($username == "staff" && $password == "staff"){
            Session::put('logged', 'staff');
            return redirect('/dashboard');
            
        }else if($username == "pembeli" && $password == "pembeli"){
            Session::put('logged', 'pembeli');
            return redirect('/market');

        }else{
            return redirect()->back()->with('error', 'Data login tidak ditemukan');
        }
    }

    public function logout(){
        Session::flush();
        return redirect('/');
    }
}
