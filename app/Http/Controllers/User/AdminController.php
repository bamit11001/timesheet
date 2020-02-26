<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminContrller extends Controller
{
    public function __construct() {
        $this->middleware('auth');
     }

     public function UserProfile(Request $request)
        {
            return view('frontend.user.profile');
        }

       

}
