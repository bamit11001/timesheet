<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Route;
use App\Models\Employer;

class EmployerRegisterController extends Controller
{
   
  public function __construct()
    {
      $this->middleware('guest:employer', ['except' => ['logout']]);
    }
    
}