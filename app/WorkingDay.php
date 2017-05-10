<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkingDay extends Model
{
    protected $table = 'working_days';

    protected $dates = ['created_at','updated_at', 'from','until'];
    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }
    public function assignments()
    {
      return $this->hasMany('App\Assignment', 'working_day_id', 'id')->orderBy('start_at', 'ASC');
    }
}
