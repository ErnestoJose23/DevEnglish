<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Term extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'topic_id',
        'term',
        'definition',
        'afi'
    ];

    public function topic(){
        return $this->belongsTo('\App\Topic')->withDefault();
    }
}
