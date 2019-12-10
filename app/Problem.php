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
    public function topic(){
        return $this->belongsTo('\App\Topic')->withDefault();
    }

    public function questions(){
        return $this->hasMany('\App\Question');
    }

    public function audio(){
        return Media::where('remember_token', $this->remember_token)->pluck('archive')->first();
    }
}
