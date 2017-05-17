<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentAndStar extends Model
{
     protected $table = 'comments_and_stars';
     protected $dates = ['created_at','updated_at'];
     protected $fillable = ['assignment_id', 'comment', 'stars', 'picture'];

     public function assignment()
    {
        return $this->hasOne('App\Assignment', 'id', 'assignment_id');
    }
}
