<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCheck;
use App\Models\Categorie;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $data;
    private $code;
    public function __construct()
    {   $this->data['kategorije'] = Categorie::all();
        $this->middleware('isLogged', ['except' => ['create','store']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('index.pages.register',$this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserCheck $request)
    {
        try{
            $korisnik = User::create(['name' => $request->name, 'surname' => $request->surname, 'email' => $request->email,
                'password' => md5($request->passwd), 'role_id' => 2]);
            if($korisnik!=null){
                $this->data['poruka'] = "Uspesno ste se registrovali";
                $this->code = 201;
            }else{
                $this->data['poruka'] = "Greska pri registraciji, pokusajte ponovo";
                $this->code = 500;
            }
        }catch (QueryException $e){
            $this->data['poruka'] = "Korisnik sa tim podacima vec postoji";
            $this->code = 409;
            echo $e->getMessage();
        }
        return response($this->data,$this->code);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if($id == session('korisnik')->id){
            $korisnik = User::find($id);
            $this->data['korisnik'] = $korisnik;
        }else{
            \Log::alert('Korisnik sa id-jem' . session('korisnik')->id . "pokusava da pristupi profilu drugog korisnika");
            return response('',404);
        }
        return view('index.pages.profile',$this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserCheck $request, $id)
    {
        echo "Izmena";
        try{
            $rez = User::where('id','=',$id)->update(['name' => $request->name, 'surname' => $request->surname, 'email' => $request->email,
                 'role_id' => 2]);
            if($rez==1){
                $this->data['poruka'] = "Uspesno izmenjen korisnik";
                $this->code = 200;
            }else{
                $this->data['poruka'] = "Greska pri izmeni podataka, pokusajte ponovo";
                $this->code = 500;
            }
        }catch (QueryException $e){
            $this->data['poruka'] = $e->getMessage();
            $this->code = 409;
        }
        return response($this->data,$this->code);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
