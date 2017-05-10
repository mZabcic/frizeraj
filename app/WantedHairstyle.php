<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WantedHairstyle extends Model
{
     protected $table = 'wanted_hairstyles';
     protected $dates = ['created_at','updated_at'];
}
