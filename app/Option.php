<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Option extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'question_id',
        'option',
        'correct'
    ];

    public function question(){
        return $this->belongsTo('\App\Question')->withDefault();
    }
}
