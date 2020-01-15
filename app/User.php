<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'isActive'
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

    public function isAdmin()
    {
        if($this->user_type_id == 1){
            return true;
        }else return false;
        
    }

    public function isTeacher(){
        if($this->user_type_id == 2){
            return true;
        }else return false;
    }
    
    public function activo(){
        return $this->isActive;
    }
    
    public function user_type(){
        return $this->belongsTo('App\UserType');
    }

    public function subscriptions(){
        return $this->hasMany('App\Subscription');
    }

}
