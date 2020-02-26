<?php

namespace App\Http\Controllers\Auth\Pass;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//Trait
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
//Password Broker Facade
use Illuminate\Support\Facades\Password;


class ForgotPasswordController extends Controller
{
    //Sends Password Reset emails
    use SendsPasswordResetEmails;

    public function __construct()
    {
      $this->middleware('guest:employer');
    }

    public function showLinkRequestForm()
    {
    	//die('rr');
        return view('employer.auth.passwords.email');
    }

	public function broker()
    {
         return Password::broker('employer');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $this->validateEmail($request);
        $response = $this->broker()->sendResetLink(
            $request->only('email')
        );

        return $response == Password::RESET_LINK_SENT
                    ? $this->sendResetLinkResponse($response)
                    : $this->sendResetLinkFailedResponse($request, $response);
    } 


}
