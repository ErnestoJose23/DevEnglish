<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'post_id',
        'content',
        'date'
    ];

    public function user(){
        return $this->belongsTo('\App\User')->withDefault();
    }

    public function post(){
        return $this->belongsTo('\App\Post')->withDefault();
    }
    
    public function images(){
        return Media::where('token', $this->token)->pluck('archive');
    }
}

