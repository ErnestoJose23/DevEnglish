<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'content',
        'chat_id',
        'user_id',
        'hasmedia'
    ];

    public function chat(){
        return $this->belongsTo('\App\Chat')->withDefault();
    }
    public function user(){
        return $this->belongsTo('\App\User')->withDefault();
    }

    public function images(){
        return Media::where('token', $this->token)->pluck('archive');
    }
}
