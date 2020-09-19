<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CategorieCheck;
use App\Models\Categorie;
use App\Models\Statistic;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    private $data;
    private $code;
    /*private function __construct(){

    }*/
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data =['kategorije'=>Categorie::all()];
        return view('admin.pages.category.review',$this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.category.insert');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategorieCheck $request)
    {
        try{
            $dali = Categorie::create(['title'=>$request->input('title')]);
            $kategorije = Categorie::all();
            $this->data = ['poruka'=>'Uspešno uneta kategorija'];
            $this->data = ['kategorije'=>$kategorije];
            $this->code = 200;
            Statistic::create(['action'=>'je uneo kategoriju sa nazivom: ' . $dali->title,'user_id'=>session('korisnik')->id]);
        }catch (QueryException $e){
            $this->data = ['poruka'=>'Ta kategorija vec postoji'];
            $this->code = 422;
            echo $e->getMessage();
            \Log::alert('Doslo je do greske prilikom unosa kategorije: ' . $e->getMessage());
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
        echo "PUT";
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
            $obrisano = Categorie::destroy($id);
            if($obrisano==1){
                $kategorije = Categorie::all();
                $this->data = ['kategorije'=>$kategorije];
                $this->code = 200;
                Statistic::create(['action'=>'je obrisao kategoriju ','user_id'=>session('korisnik')->id]);
            }else{
                $this->data = ['poruka'=>"Ta kategorija ne postoji!"];
                $this->code = 500;
            }
        }catch (QueryException $e){
            $this->data = ['poruka'=>"Greška prilikom brisanja, pokušajte ponovo!"];
            $this->code = 422;
            \Log::alert('Greska u upitu prilikom brisanja kategorije: ' . $e->getMessage());
        }
        return response($this->data,$this->code);

    }
}
