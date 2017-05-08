<?php

namespace App;

use Illuminate\Notifications\Notifiable;
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
    
    
    public function role()
    {
        return $this->belongsTo('App\Role', 'role');
    }

     public function isAdmin()
    {
        foreach ($this->role()->get() as $role)
        {
            if ($role->name == 'admin')
            {
                return true;
            }
        }

        return false;
    }

    public function hasRole($role) {
        foreach ($this->role()->get() as $item)
        {
            if ($item->name == $role)
            {
                return true;
            }
        }

        return false;

    }
}
