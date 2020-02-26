<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
class EmployerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:employer');
    }
    /**
     * show dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //die("rfg");
        return view('frontend.user_sign_up');
    }

    
}