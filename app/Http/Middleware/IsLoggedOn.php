<?php

namespace App\Http\Middleware;

use Closure;

class IsLoggedOn
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
        if(session()->has('korisnik'))
            return $next($request);
        else{
            \Log::alert("Sa ove ip adrese: " . $request->ip() . " pokušava da pristupi stranicama koje mu nisu dozvoljene");
        }
        return redirect()->route('home');
    }
}
