<?php

namespace App\Http\Controllers;

use App\UserProblem;
use Auth;
use Illuminate\Http\Request;
use App\Services\CalculateGrade;

class UserProblemController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $CalculateGrade = new CalculateGrade;
        $UserProblem = new UserProblem();

        $UserProblem->fill($request->all());
        $UserProblem->user_id = Auth::id();

        $UserProblem->wrong = $CalculateGrade->getWrongAnswers($request);
        $UserProblem->grade = $CalculateGrade->getGrade($request->right, $request->cont);

        $UserProblem->save();
        return $UserProblem;
    }

}
