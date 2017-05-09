<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
     protected $table = 'jobs';
     protected $dates = ['created_at','updated_at'];
}
