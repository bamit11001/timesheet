<?php 
namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmployerSessionController extends Controller 

{
	public function __construct()
    {
      $this->middleware('guest:employer');
    } 

	public function session(Request $request)
	{
		$request->session()->put('key', 'value');
	}

}
