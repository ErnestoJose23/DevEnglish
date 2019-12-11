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
        'name', 'email', 'password', 'active'
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

    public function activo(){
        return $this->active;
    }

    public function user_type(){
        return $this->belongsTo('App\UserType');
    }

    public function media(){
        return $this->belongsTo('App\Media');
    }

    public function subscriptions(){
        return $this->hasMany('App\Subscription');
    }

}
