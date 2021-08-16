<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // return view('home');
        $role = Auth::user()->role;
        if($role == "admin"){
            return redirect()->to('index');
        } else if($role == "penulis"){
            return redirect()->to('penulis');
        }
        else if($role == "pembaca"){
            return redirect()->to('pembaca');
        }else {
            return redirect()->to('logout');
        }
    }
}
