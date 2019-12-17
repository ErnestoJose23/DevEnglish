<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserTopic extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'topic_id',
        'user_id'
    ];

    public function user(){
        return $this->belongsTo('\App\User')->withDefault();
    }

    public function topic(){
        return $this->belongsTo('\App\Topic')->withDefault();
    }

}
