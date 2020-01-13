<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'title',
        'content',
        'isActive',
        'token'
    ];

    public function user(){
        return $this->belongsTo('\App\User')->withDefault();
    }
    
    public function comments(){
        return $this->hasMany('\App\Comment');
    }

    public function images(){
        return Media::where('token', $this->token)->pluck('archive');
    }
}
