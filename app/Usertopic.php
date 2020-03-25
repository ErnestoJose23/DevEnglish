<?php

namespace App;

use Auth;
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

    public static function subscribed(Topic $topic){
        $userTopic = UserTopic::where('user_id', Auth::id())->where('topic_id', $topic->id)->get();
        if($userTopic->count() > 0){
            return true;
        }else return false;
    }

    public function subscriptions(User $user){
        return UserTopic::where('user_id', $user->id)->with('topic')->get();
    }
    public function subscriptionsList(User $user){
        return UserTopic::where('user_id', $user->id)->with('topic')->get();
    }

    public function assigned(Int $id){
        $assigned = UserTopic::where('topic_id', $id)->get();
        $teacherAssigned = [];
        foreach($assigned as $i){
            $teacherAssigned[] += $i->user_id;
        }

        $teachersAssigned_ = User::where('user_type_id', 2) ->whereIn('id',$teacherAssigned)->first();


        return $teachersAssigned_->id;
    }
}
