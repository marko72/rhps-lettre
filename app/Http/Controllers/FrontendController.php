<?php

namespace App\Http\Controllers;


use App\Models\Categorie;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Statistic;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    private $data;

    function __construct()
    {
        $this->data['kategorije'] = Categorie::all();
    }

    public function index(){
        $najnovije = Post::latest();
        $poKategoriji = Categorie::with(['posts.picture','posts.comments'])->paginate(3);
        $najpopularnije = Post::mostPopular();
        $this->data['najnovije'] = $najnovije['vesti'];
        $this->data['poKategoriji'] = $poKategoriji;
        $this->data['najpopularnije'] = $najpopularnije;
        return view('index.pages.home',$this->data);
    }


    public function singleNews($id){
        $vest = Post::with('picture','comments','categories','user')->withCount('comments as brKomentara')->where(['id'=>$id])->first();
        $this->data['vest'] = $vest;
        /*dd($this->data);*/
        return view('index.pages.single-post',$this->data);
    }

    public function login(){
        return view('index.pages.login',$this->data);
    }

    public function register(){
        return view('index.pages.register',$this->data);
    }

    public function comment(Request $request){
        try{
            $rez = Comment::create(['post_id' => $request->postID,'user_id' => $request->usrID,'content' => $request->message]);
            if($rez == null){
                $this->data['poruka'] = "Serverska greska pri unosu, pokusajte ponovo";
            }else{
                $postSaKomentarima = Comment::getComments($request->postID);
                $this->data['komentari'] = $postSaKomentarima->comments;
                Statistic::create(['action'=>'je postavio komentar na vest koja ima naslov ' . $postSaKomentarima->title,'user_id'=>$request->usrID]);
            }
        }catch (QueryException $e){
            $this->data['poruka'] = "Greška pri komentarisanju, pokušajte ponovo";
        }
        return response($this->data);
    }

    public function uncomment(Request $request){
        try{
            $rez = Comment::destroy($request->idComment);
            if($rez == 0){
                $this->data['poruka'] = "Serverska greska prilikom brisanja";
            }else{
                $this->data['poruka'] = "Uspesno obrisano ";
                $postSaKomentarima = Comment::getComments($request->idPost);
                $this->data['komentari'] = $postSaKomentarima->comments;
                Statistic::create(['action'=>'je obrisao komentar sa vesti koja ima naziv ' . $postSaKomentarima->title, 'user_id'=>$request->userID]);
            }
        }catch (QueryException $e){
            $this->data['greska'] = $e->getMessage();
        }
        return response($this->data);
    }

    public function newsByCategory($id){
        $kategorija = Categorie::find($id);
        $this->data['kategorija'] = $kategorija;
        $poKategoriji = Post::newsByCategory($id);
        $this->data['vesti'] = $poKategoriji['vesti'];
        return view('index.pages.category-news',$this->data);
    }

    public function news(){
        $najnovije = Post::latest();
        $this->data['vesti'] = $najnovije['vesti'];
        $brStrana = ceil($najnovije['brojVesti']/5);
        $this->data['brStrana'] = $brStrana;
        return view('index.pages.news',$this->data);
    }

    public function paginateNews(Request $request, $pg){
        try{
            if($request->search){
                $this->data['vesti'] = Post::searchPaginate($request->search, $pg);
                $this->code = 200;
            }else{
                $this->data['vesti'] = Post::paginacija($pg);
                $this->code = 200;
            }

        }catch (QueryException $e){
            $this->data['greska'] = "Greška";
            $this->code = 409;
        }
        return response($this->data,$this->code);
    }

    public function searchNews(Request $request){
        try{
            $data = Post::search($request->search);
            $this->data['vesti'] = $data['vesti'];
            $this->data['brojStrana'] = ceil($data['brojVesti']/3);
        }catch (QueryException $e){
            echo $e->getMessage();
            $this->data = $e->getMessage();
        }
        return response($this->data);
    }

    public function autor(){
        return view('index.pages.autor',$this->data);
    }

}