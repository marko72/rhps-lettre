<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public static function getComments($postID){
        return Post::with('comments')->withCount('comments as brKomentara')->where(['id' => $postID])->first();
    }

    protected $fillable = ['post_id','user_id','content'];
}
