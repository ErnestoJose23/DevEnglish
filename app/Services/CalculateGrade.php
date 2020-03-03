<?php

namespace App\Services;

use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\User;
use App\UserProblem;

class CalculateGrade 
{
    function getGrade(int $correct, int $questions){
        $grade = (($correct *100) / $questions);
        return round($grade, 2);
    }

    function getWrongAnswers(request $request){
        return $request->cont - $request->right;
    }
}
