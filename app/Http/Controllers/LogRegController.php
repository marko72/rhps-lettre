<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginCheck;
use App\Models\Statistic;
use App\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class LogRegController extends Controller
{


    public function login(LoginCheck $request){

        $passwd = $request->input('passwd');
        $email = $request->input('email');

        try{
            $data = null;
            $korisnik = \App\Models\User::with('role')->where(
                [
                    ['email','=',$email],
                    ['password','=',md5($passwd)]
                ])->first();
            if($korisnik==null){
                session(['poruka'=>'Vaši podaci nisu dobri!']);
            }else{
                session(['korisnik'=>$korisnik]);
                try{
                    Statistic::create(['action'=>'je se ulogovao na sajt','user_id'=>session('korisnik')->id]);
                }catch (QueryException $e){
                    \Log::alert('Logovanje nije upisano u bazu');
                }
                return redirect()->route('home');
            }
        }catch (QueryException $e){
            session(['poruka'=>"Greška prilikom logovanja, pokušajte ponovo!"]);
        }
        return redirect()->route('showLogin');
    }

    public function logout(){
        if(session()->has('korisnik')){
            try{
                Statistic::create(['action'=>'je se izlogovao sa sajta','user_id'=>session('korisnik')->id]);
            }catch (QueryException $e){
                \Log::alert('Logovanje nije upisano u bazu zbog greske: '.$e->getMessage());
            }
            session()->forget('korisnik');
            return redirect()->route('home');
        }else{
            return redirect()->route('showLogin');
        }
    }
}
