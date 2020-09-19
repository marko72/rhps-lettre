<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PostCheck;
use App\Models\Categorie;
use App\Models\Picture;
use App\Models\Post;
use App\Models\Statistic;
use function GuzzleHttp\Promise\all;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use mysql_xdevapi\Exception;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class PostController extends Controller
{
    private $data;
    private $status;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $postovi = Post::with('categories','comments','picture','user')->skip(0)->take(3)->get();
        $this->data['postovi'] = $postovi;
        $ukupnoPostova = \DB::table('posts')->count();
        $this->data['brojStrana'] = ceil($ukupnoPostova/3);
        return view('admin.pages.post.review',$this->data);
    }

    public function paginate($br){
        try{
            $this->data['postovi'] = Post::paginacija($br);
            $this->code = 200;
        }catch (QueryException $e){
            $this->data['greska'] = "Greška";
            $this->code = 409;
        }
        return response($this->data,$this->code);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategorije = Categorie::all();
        $this->data = ['kategorije'=>$kategorije];
        return view('admin.pages.post.insert',$this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostCheck $request)
    {
        if($request->hasFile('picture')){
            $slika = $request->file('picture');
            $novoIme = time().$slika->getClientOriginalName();
            try{
                $slika->move('images/news/',$novoIme);
                $rez = \DB::transaction(function () use ($request, $novoIme){
                    $rezPic = Picture::create(['path'=>$novoIme]);
                    $rez = $rezPic->post()->create([
                        'title'=>$request->input('title'),
                        'content'=>$request->input('content'),
                        'picture_id'=>$request->input('title'),
                        'user_id'=>$request->input('user'),
                        'category_id'=>$request->input('cat-id')
                    ]);
                    return $rez;
                });
                Statistic::create(['action'=>"je uneo post sa id-jem: " . $rez->id,'user_id'=>session('korisnik')->id]);
                session(['poruka'=>'Uspešno unet post!']);
            }catch (FileException $e){
                session(['poruka'=>'Greška prilikom premeštanja slike']);
                \Log::alert("Greska prilikom premestanja slike pri unosu sa opisom: " . $e->getMessage());
            }
            catch (QueryException $e){
                session(['poruka'=>$e->getMessage()]);
                \Log::alert("Greska u upitu pri unosu sa opisom: " . $e->getMessage());
            }
            return redirect()->route('posts.create');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try{
            $post = Post::find($id);
            $this->data['proizvod'] = $post;
            $categories = Categorie::all();
            $this->data['kategorije'] = $categories;

            if($post==null){
                $this->data = ['poruka'=>'Nema tog posta'];
            }else{
                $this->data['proizvod'] = $post;
                $this->status = 200;
            }
        }catch (QueryException $e){
            $this->data = ['poruka'=>'Nema tog posta'];
        }
        return view('admin.pages.post.post-single',$this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostCheck $request, $id)
    {
        $post = Post::find($id);
        if($request->has('picture')){
            $picture = Picture::find($post->picture_id);
            $slika = $request->file('picture');
            $novoIme = time().$slika->getClientOriginalName();
            try{
                $slika->move(public_path().'/images/news/',$novoIme);
                $rezPic = Picture::where(['id'=>$post->picture_id])->update([
                   'path'=>$novoIme
                ]);
                if($rezPic==1){
                    $rez = $post->update(['title'=>$request->title,'content'=>$request->content,'cat-id'=>$request->category_id,'user_id'=>$request->user]);
                    if ($rez==1){
                        $this->data['poruka'] ="Uspesna izmena";
                        Statistic::create(['action'=>"je izmenio post sa id-jem: " . $id,'user_id'=>session('korisnik')->id]);
                    }else{
                        $this->data['poruka'] ='Greska pri izmeni';
                    }
                }else{
                    $this->data['poruka'] = "Nije uspelo premestanje slike";
                }
            }catch (FileException $e){
                $this->data['poruka']='Greška prilikom premeštanja slike';
                \Log::alert('Nestala je greska prilikom premestanja slike pri izmeni');
            }
            catch (QueryException $e){
                $this->data['poruka']="Greška pri izmeni posta, pokušahte ponovo";
                \Log::alert('Nestala je greska pri upitu prilikom izmene');
            }
        }else{
            try{
                $rez = $post->update(['title'=>$request->title,'content'=>$request->content,'cat-id'=>$request->category_id,'user_id'=>$request->user]);
                if ($rez==1){
                    $this->data['poruka'] ="Uspesna izmena";
                    Statistic::create(['action'=>"je izmenio post sa id-jem: " . $id,'user_id'=>session('korisnik')->id]);
                }else{
                    $this->data['poruka'] ='Greska pri izmeni';
                }

            }catch (SQLException $e){
                $this->data['poruka'] = 'Greska servera pri izmeni, pokusajte kasnije';
                \Log::alert('Greska pri upitu za izmenu posta bez slike sa opisom: ' . $e->getMessage());
            }
        }
        return redirect('/posts/'.$id.'/edit')->with($this->data);
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
            $obrisano = Post::destroy($id);
            if($obrisano==1){
                $post = Post::with(['picture','user','categories'])->get();
                $this->data['postovi']=$post;
                $this->status = 200;
                Statistic::create(['action'=>"je obrisao post",'user_id'=>session('korisnik')->id]);
            }else{
                $this->data['greska'] = "Serverska greska pri brisanju, pokušajte kasnije";
                $this->status = 500;
            }
        }catch (QueryException $e){
            $this->data['greska'] = $e->getMessage()/*"Greška prilikom brisanja, pokušajte kasnije"*/;
            $this->status = 409;
        }
        return response($this->data,$this->status);
    }
}
