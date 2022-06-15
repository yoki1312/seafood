<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
// use Session;
use Illuminate\Support\Facades\URL;

class isSuper
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

        if(isset($request->params)){
            \Session::put('linkSession', URL::current());
        }
        if(!isset(Auth::guard('admin')->user()->id)){
            toastr()->warning('Anda perlu login ', 'Warning!');
            return redirect('login/supplier');
        }else{
            $sessionLink = null;
            if(\Session::get('linkSession') != null){
                $sessionLink = \Session::get('linkSession');
                \Session::forget('linkSession');
                return redirect($sessionLink);
            }
        }
        
        return $next($request);
    }
}