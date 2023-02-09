<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function dashboard(){
        return view('dashboard');
    }

    public function barang(){
        return view('barang');
    }

    public function staff(){
        return view('staff');
    }

    public function pembeli(){
        return view('pembeli');
    }

    public function konfirmasi(){
        return view('konfirmasi');
    }
}
