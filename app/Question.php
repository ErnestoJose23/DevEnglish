<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'problem_id',
        'title',
    ];

    public function problem(){
        return $this->belongsTo('\App\Problem')->withDefault();
    }

    public function options(){
        return $this->hasMany('\App\Option');
    }
}
