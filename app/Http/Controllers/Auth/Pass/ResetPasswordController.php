<?php

namespace App\Http\Controllers\Auth\Pass;
// use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
//Auth Facade
use Illuminate\Support\Facades\Auth;
//Password Broker Facade
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */
    use ResetsPasswords;
    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/employer';
    public function __construct()
    {
      $this->middleware('guest:employer');
    }

    public function showResetForm(Request $request, $token = null)
    {
        return view('employer.auth.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    public function broker()
    {
        return Password::broker('employer');
    }

    protected function guard()
    {
        return Auth::guard('employer');
    }
}
