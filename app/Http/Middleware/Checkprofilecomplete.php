<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\Employer;
class Checkprofilecomplete
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $id = Auth::id();
        if(Employer::where('id','=',$id)->whereNull('company_id')->exists()){
            return redirect()->intended(route('employer.editprofile'));
        }
        return $next($request);
    }
}
