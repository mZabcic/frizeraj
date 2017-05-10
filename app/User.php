<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Role as Role;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name',  'email', 'password', 'role', 'favorite_hairdresser'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $table = 'users';
    
    
    public function roleNav()
    {
        return $this->belongsTo(Role::class, 'role');
    }

     public function isAdmin()
    {
       
            if ($this->roleNav->name == 'admin')
            {
                return true;
            }
        

        return false;
    }

    public function hasRole($role) {
       
            if ($this->roleNav->name == $role)
            {
                return true;
            }
        

        return false;

    }
}
