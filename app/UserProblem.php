<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserProblem extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'problem_id',
        'right',
        'wrong',
        'grade',
        'topic_id'
    ];

    public function user(){
        return $this->belongsTo('\App\User')->withDefault();
    }

    public function problem(){
        return $this->belongsTo('\App\Problem')->withDefault();
    }

    public function topic(){
        return $this->belongsTo('\App\Topic')->withDefault();
    }
}

/* Cambiar nombre a calificaciones pj, option y success fuera, 


//Funcion N-aciertos 
