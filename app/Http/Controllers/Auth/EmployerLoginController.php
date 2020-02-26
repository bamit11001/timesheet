<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Route;
use App\Models\Employer;
use Session;

class EmployerLoginController extends Controller
{
   
    public function __construct()
    {
      $this->middleware('guest:employer', ['except' => ['logout']]);
    }
    
    public function showLoginForm()
    {
      return view('employer.auth.employer_login');
    }
    
    public function login(Request $request)
    {
      // Validate the form data
      $this->validate($request, [
        'email'   => 'required|email',
        'password' => 'required|min:6'
      ]);
      
      // Attempt to log the user in
      if (Auth::guard('employer')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
        // if successful, then redirect to their intended location
        return redirect()->intended(route('employer.dashboard'));
      } 

      // if unsuccessful, then redirect back to the login with the form data
       return redirect()->back()->withInput($request->only('email', 'remember'))->with('status', 'Email / Password is wrong.');
      
    
     
    }
    
    public function logout()
    { 
        Auth::guard('employer')->logout();
        return redirect('/employer/login');
    }

    public function showRegisterForm()
    {
      return view('employer.auth.employer_register');
    }


    public function create (Request $request)
    {
      /**
      * Get a validator for an incoming registration request.
      *
      * @param  array  $request
      * @return \Illuminate\Contracts\Validation\Validator
      */
      $this->validate($request, [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'phone' => ['required', 'numeric', 'digits:10'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
        'terms' => ['accepted'],
      ]);

      /**
        * insert the  registration request.
        *
        * @param  array  $request
      */

        $user = new Employer;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->password = $request->input('password');
        $user->is_owner = 1;
        $inserted = $user->save();

        if($inserted)
        {
           if (Auth::guard('employer')->attempt(['email' => $user->email, 'password' => $request->input('password')], $request->remember)) 
            {
            
                return redirect()->intended(route('employer.editprofile'))->with('status', 'Congratulations! You’ve successfully registered' );

            }            
        }
            return redirect()->intended(route('employer.login'));
    }

    
}