<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminUsersController extends Controller
{
    private $data;
    private $code;
    /**
     *
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $korisnici = User::with('role')->get();
        $this->data['korisnici'] = $korisnici;

        return view('admin.pages.user.review',$this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $uloga = $request->uloga;
        try{
            $rez = User::where('id',"=",$id)->update([
                'role_id'=>$uloga
            ]);
            if($rez==1){
                $this->data['poruka'] = "Uspesno izmenjena uloga korisnika";
                $this->code = 200;
            }else{
                $this->data['poruka'] = "Korisnik sa tom ulogom vec postoji";
                $this->code = 500;
            }
        }catch (QueryException $e){
            $this->data['poruka'] = "Greska pri izmeni, pokusajte ponovo";
            $this->code = 422;
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
        try{
            $rez = User::destroy($id);
            if($rez==1){
                $korisnici = User::with('role')->get();
                $this->data['korisnici'] = $korisnici;
                $this->data['poruka'] = "Uspesno obrisan korisnik";
                $this->code = 200;
            }else{
                $this->data['poruka'] = "Korisnik je vec obrisan";
                $this->code = 500;
            }
        }catch (QueryException $e){
            $this->data['poruka'] = "Greska pri brisanju, pokusajte ponovo";
            $this->code = 422;
        }
        return response($this->data,$this->code);
    }
}
