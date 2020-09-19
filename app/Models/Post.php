<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function categories(){
        return $this->belongsTo('App\Models\Categorie','category_id');
    }

    public static function paginacija($br){
        return Post::with('categories','comments','picture','user')->skip($br)->take(3)->get();
    }
    public static function latest(){
        $data['brojVesti'] =  Post::with(['picture','comments','categories'])->orderBy('created_at','desc')->count();
        $data['vesti'] = Post::with(['picture','comments','categories'])->orderBy('created_at','desc')->withCount('comments as brKomentara')->limit(5)->get();
        return $data;
    }

    public static function newsByCategory($category_id){
        $data['vesti'] = Post::with(['picture','comments','categories'])->where('category_id',"=",$category_id)->withCount('comments as brKomentara')->paginate(3);
        return $data;
    }

    public static function search($var){
        $data = [];
        $data['brojVesti'] = Post::with(['picture','comments','categories'])->where('title','like','%'.$var.'%')->count();
        $data['vesti'] = Post::with(['picture','comments','categories', 'user'])->where('title',"like",'%'.$var .'%')->withCount('comments as brKomentara')->limit(3)->get();
        return $data;
    }

    public static function searchPaginate($var,$br){
        return Post::with(['picture','comments','categories', 'user'])->where('title',"like",'%'.$var .'%')->withCount('comments as brKomentara')->skip($br)->take(3)->get();
    }

    /*public static function paginateSearch($skip, $var){
        $data = [];
        $data['brojVesti'] = Post::with(['picture','comments','categories'])->where('title',"like",'%'.$var .'%')->count();
        $data['vesti'] = Post::with(['picture','comments','categories'])->where('title',"like",'%'.$var .'%')->withCount('comments as brKomentara')->skip($skip)->take(3)->get();
        $data['akcije'] = Statistic::with('user')->where('action','like','%'.$var.'%')->limit(5)->get();
        return $data;
    }*/
    public static function mostPopular(){
        return Post::with(['picture','comments','categories'])->withCount('comments as brKomentara')->orderBy('brKomentara','desc')->limit(5)->get();
    }

    public function comments(){
        return $this->belongsToMany('App\Models\User',"comments")->withPivot('id', 'post_id','user_id','content','created_at');
    }
    public function picture(){
        return $this->belongsTo('App\Models\Picture');
    }
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    protected $fillable = ['title','content','picture_id','user_id','category_id'];
}