<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProblemType extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'type',
    ];

    public function problems(){
        return $this->hasMany('App\Problem');
    }

}