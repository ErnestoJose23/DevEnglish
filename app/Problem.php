<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Problem extends Model
{
    
    use SoftDeletes;

    protected $fillable = [
        'topic_id',
        'type',
        'title',
        'content',
        'file',
        'active',
        'token'
    ];

    public function problem_type(){
        return $this->belongsTo('App\ProblemType');
    }

    public function topic(){
        return $this->belongsTo('\App\Topic')->withDefault();
    }

    public function questions(){
        return $this->hasMany('\App\Question');
    }

    public function audio(){
        return Media::where('token', $this->token)->pluck('archive')->first();
    }

    public static function tests(){
        return Problem::where('problem_type_id', 1)->get();
    }

    public static function listenings(){
        return Problem::where('problem_type_id', 2)->get();
    }

    public static function rellenarhuecos(){
        return Problem::where('problem_type_id', 3)->get();
    }

    public static function fallos(){
        return Problem::where('problem_type_id', 4)->get();
    }
}
