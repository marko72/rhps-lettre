<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\Statistic;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    private $data;
    private $code;
    public function showStatistic(){
        $aktivnosti = Statistic::with('user')->skip(0)->take(5)->get();
        $this->data['aktivnosti'] = $aktivnosti;
        $ukunoStatistike = \DB::table('statistics')->count();
        $this->data['brojStrana'] = ceil($ukunoStatistike/5);
        return view('admin.pages.statistics',$this->data);
    }

    public function paginate(Request $request, $br){
        try{
            if($request->pretraga){
                $this->data['aktivnosti'] = Statistic::paginacijaPretraga($request->pretraga, $br);
                $this->code = 200;
            }else{
                $this->data['aktivnosti'] = Statistic::paginacija($br);
                $this->code = 200;
            }
        }catch (QueryException $e){
            $this->data['greska'] = "Greška";
            $this->code = 409;
        }
        return response($this->data,$this->code);
    }

    public function paginateByDate(Request $request,$br){
        try{
            $data = Statistic::pretraga($request->search);
            /*$this->data = $data;*/
            $this->data['aktivnosti'] = $data['akcije'];
            $this->data['brojStrana'] = ceil($data['brojAkcija']/5);
        }catch (QueryException $e){
            echo $e->getMessage();
            $this->data = $e->getMessage();
        }
        return response($this->data);

        /*echo $request->datum;*/
        /*$dtime = \DateTime::createFromFormat("Y-m-d", $request->datum);
        $dtime2 = \DateTime::createFromFormat("Y-m-d", '2019-03-23');
        if($dtime2>$dtime){
            echo "Veci je 23 od izabranog";
        }else{
            echo "manji je";
        }
        $timestamp = $dtime->getTimestamp();
        echo $timestamp;
        echo " Vreme je:".date('y-M-d',$timestamp);*/
        /*try{
            $this->data['aktivnosti'] = Statistic::paginacija($br);
            $this->code = 200;
        }catch (QueryException $e){
            $this->data['greska'] = "Greška";
            $this->code = 409;
        }
        return response($this->data,$this->code);*/
    }
}
