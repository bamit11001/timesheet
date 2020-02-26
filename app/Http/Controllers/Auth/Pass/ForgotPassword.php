<?php

namespace App\Http\Controllers\Auth\Pass;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employer;
use Sentinel;
use Reminder;
use Mail;


use Illuminate\Support\Facades\Redirect;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Hash;


class ForgotPassword extends Controller
{
    //
    public function forgot()
    {
    	return view('employer.auth.forgot');
    }

    public function password(Request $request)
    {
    	$employer = Employer::whereEmail($request->email)->first();
    	if($employer === null){
    		return redirect()->back()->with(['errors' => 'Email not exists']);
    	}
    	//print_r($employer->id); die();
    	//$employer = Sentinel::findById($employer->id);    	
    	$employer = Employer::find($employer->id);
    	$reminder = Reminder::exists($employer) ? : Reminder::create($employer);
    	$this->sendEmail($employer, $reminder->code);
    	return redirect()->back()->with(['success' => 'Reset code send to your email ']);
    }

    public function sendEmail($employer, $code )
    {
    	 Mail::send(
    	 	'employer.auth.email.forgot',
    	 	['employer'=> $employer, 'code'=> $code],
    	 	 function($message) use ($employer) {
    	 	 	$message->to ($employer->email);
    	 	 	$message->subject(" $employer->name, reset your password.");
    	 	 }
    	 	
    	 );
    }


    public function reset(request $request)
    {
    	$employer = Employer::whereEmail($email)->first();
	    	if($employer == null){
	    		echo 'Email not exists';
	    	}

    	$employer = Employer::find($employer->id);
    	$reminder = Reminder::exists($employer) ? : Reminder::create($employer);

    	if ($reminder) 
	    	{
	    		if ($code == $reminder->code) 
		    		{
		    			return view('employer.auth.passwords.reset');
		    		}
	    			else
		    		{
		    			return redirect('/employer');
		    		}
	    	}
    	else
    	{
    		echo 'time expired';
    	}
    }

    public function resetPassword(Request $request, $email, $code)
    {
    	$this->validate($request, [
    		'password' => 'required|min:7|max:12|confirmed',
    		'password_confirmation' => 'required|min:7|max:12',
    		'password' => 'required|min:7|max:12|confirmed',
    	] );

    	$employer = Employer::whereEmail($email)->first();
    	
    	if($employer == null){
    		
    		echo 'Email not exists';
    	}

    	$employer = Employer::find($employer->id);
    	$reminder = Reminder::exists($employer);

    	if ($reminder) 
    		{
    		if ($code == $reminder->code) {
    			Reminder::complete($user, $code, $request->password);
    			return redirect('/login')->with('success','password reset please login with new password');
    		}else {
    			return redirect('/');
    		}
    	}else {
    		echo 'time expired';
    	}

    }

}


