<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckMail;
use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;

class SendEmailController extends Controller
{
    private $data;
    public function index(){
        $this->data['kategorije'] = Categorie::all();
        return view('index.pages.contact',$this->data);
    }

    public function send(CheckMail $request){
        $data = [
            "name"=>$request->name,
            "message"=>$request->message,
            "email"=>$request->email
        ];
        \Mail::to('rhps.news2@gmail.com')->send(new SendMail($data));
        session(['poruka'=>"Uspesno poslat mejl sa sajta"]);
        return back();
    }
}
