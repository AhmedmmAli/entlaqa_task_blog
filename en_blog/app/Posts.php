<?php

namespace App;
use App\Comments;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
        public function user()
    {
        return $this->belongsTo('App\User');
    }
     
     public function displayAllComments($postID){
     $comments = Comments::where('post_id','=',$postID)->get();
     return $comments;
    }
}
