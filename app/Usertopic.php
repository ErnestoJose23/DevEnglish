<?php

namespace App;

use App\UserTopic;
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

    public function subscriptions(User $user){
        return UserTopic::where('user_id', $user->id)->with('topic.media')->get();
    }
}
