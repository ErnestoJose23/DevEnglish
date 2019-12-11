<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserType extends Model
{
    

    protected $fillable = [
        'type'
    ];

    public function users(){
        return $this->hasMany('App\User');
    }

    public static function admins(){
        $users = UserType::find(1)->users;
        return $type;
    }
    public function teachers(){
        $type = UserType::find(2)->users;
        return $type; 
    }

    public function students(){
        $type = UserType::find(3)->users;
        return $type;
    }
}