<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Problem extends Model
{
    
    use SoftDeletes;

    protected $fillable = [
        'topic_id',
        'problem_type_id',
        'title',
        'content',
        'file',
        'isActive',
        'display',
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
}
