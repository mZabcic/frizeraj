<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
     protected $table = 'assignments';
     protected $dates = ['created_at','updated_at', 'start_at'];
       public function user()
    {
        return $this->hasOne('App\User','id','customer_id');
    }
    public function job(){
      return $this->hasOne('App\Job','id','job_id');
    }

     public function working_day(){
      return $this->hasOne('App\WorkingDay','id','working_day_id');
    }
}
