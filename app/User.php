<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Role;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',"role_id"
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role(){
        return $this->belongsTo("App\Role", "role_id");
    }

    public function job(){
        return $this->hasMany("App\Job");
    }

    public function isMod()
    {
        $user = User::find(auth()->user()->id);
        $role = $user->role()->first()->name;

        if($role==="job board moderator"){
            return true;
        }
        else{
            return false;
        }
        
    }

    public function isHR()
    {
        $user = User::find(auth()->user()->id);
        $role = $user->role()->first()->name;

        if($role==="hr manager"){
            return true;
        }
        else{
            return false;
        }
        
    }

}
