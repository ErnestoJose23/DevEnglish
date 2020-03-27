<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Chat extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'content',
        'token',
        'solved',
        'topic_id',
        'user_id'
    ];

    public function user(){
        return $this->belongsTo('\App\User')->withDefault();
    }

    public function topic(){
        return $this->belongsTo('\App\Topic')->withDefault();
    }

    public function messages(){
        return $this->hasMany('App\Message');
    }

    public function images(){
        return Media::where('token', $this->token)->pluck('archive');
    }
    
    public function studentQuestions(Topic $topic){
        return Chat::where('topic_id', $topic->id)->get();
    }
}
