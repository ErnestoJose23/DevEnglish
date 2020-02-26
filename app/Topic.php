<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Topic extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'isActive',
        'description'
    ];

    public function resources(){
        return $this->hasMany('App\Resource');
    }

    public function problems(){
        return $this->hasMany('App\Problem');
    }
    
    public function subscriptions(){
        return $this->hasMany('App\UserTopic');
    }
}
