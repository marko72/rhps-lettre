<?php

namespace App\Http\Middleware;

use Closure;

class CheckIsAdmin
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
        if(session()->has('korisnik')){
            if(session('korisnik')->role->id == 1){
                return $next($request);
            }else{
                \Log::critical('Korisnik' . session('korisnik')->email . "koji je registrovan pokusava da pristrupi admin panelu");
            }
        }else{
            \Log::critical('Korisnik sa adrese' . $request->ip() . " pokusava da pristrupi admin panelu");
        }
        return redirect()->route('home');
    }
}
