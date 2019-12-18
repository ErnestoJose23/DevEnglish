<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Resource extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'topic_id',
        'url',
        'title',
        'descp',
        'active',
        'token',
        'tipe'
    ];

    public function topic(){
        return $this->belongsTo('\App\Topic')->withDefault();
    }

    public function images(){
        return Media::where('token', $this->token)->pluck('archive');
    }
}
