<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkingDay extends Model
{
     protected $table = 'working_days';

     protected $dates = ['created_at','updated_at', 'from','until'];
       public function user()
    {
        return $this->hasOne('App\User','id','user_id');
    }

}
