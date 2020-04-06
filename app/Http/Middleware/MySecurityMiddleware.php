<?php

namespace App\Http\Middleware;

/*
 Project name/Version: LaravelCLC Version: 5
 Module name: Security Module
 Authors: Jack Setrak
 Date: 03/14/2020
 Synopsis: Security middleware that will redirect anyone trying to gain access to pages they don't have permission to
 Version#: 1
 References: N/A
 */

use Illuminate\Support\Facades\Session;
use Closure;

class MySecurityMiddleware
{
    /**
     * Handle an incoming page request and make sure the necessary permissions are met.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){
        $path = $request->path();
        
        //exception pages that don't require a user to be logged in 
        $secureCheck = true;
        if($request->is('/') ||
            $request->is('login') ||            
            $request->is('doLogin') || 
            $request->is('register') || 
            $request->is('doRegister') ||
            $request->is('userProfile/*') ||
            $request->is('allJobs') ||
            $request->is('getJob/*')) 
        {
            $secureCheck = false;    
        }
        
        $enable = true;
        //if username is set in session then a user is logged in 
        if(Session::get("User") != null){
            $enable = false;
        }
        
        //if the user isn't logged and the page isn't one of the exception pages above, then redirect the user back to the login page
        if($enable && $secureCheck){
            return redirect('/login');
        }
        
        //proceed as normal to next middleware in chair
        return $next($request);
    }
}
