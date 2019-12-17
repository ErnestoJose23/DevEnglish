<?php

namespace App\Http\Controllers\intranet;

use Auth;
use App\UserTopic;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminTeacherTopicController extends Controller
{
    public function getUnassigned(int $topic_id){
        $assigned = UserTopic::where('topic_id', $topic_id)->get();
        $teacherAssigned = [];
        foreach($assigned as $i){
            $teacherAssigned[] += $i->user_id;
        }
        return User::where('user_type_id', 2) ->whereNotIn('id',$teacherAssigned)->get();
    }


}