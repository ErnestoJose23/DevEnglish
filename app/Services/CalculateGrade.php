<?php

namespace App\Services;

use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\User;
use App\UserProblem;

class CalculateGrade 
{
    function CalculateGradeTest(request $request){  
        $UserProblem = new UserProblem();
        $UserProblem->fill($request->all());
        $UserProblem->wrong = $request->cont - $UserProblem->right;
        $grade = ($UserProblem->right *100) / $request->cont;
        $grade = round($grade, 2);
        $UserProblem->grade = $grade;

        return $UserProblem;
    }
}
