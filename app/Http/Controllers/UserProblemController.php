<?php

namespace App\Http\Controllers;

use App\UserProblem;
use Auth;
use Illuminate\Http\Request;
use App\Services\CalculateGrade;

class UserProblemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $UserProblem = (new CalculateGrade)->CalculateGrade($request);
        $UserProblem->user_id = Auth::id();
        $UserProblem->save();
        return $UserProblem;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UserProblem  $userProblem
     * @return \Illuminate\Http\Response
     */
    public function show(UserProblem $userProblem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserProblem  $userProblem
     * @return \Illuminate\Http\Response
     */
    public function edit(UserProblem $userProblem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserProblem  $userProblem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserProblem $userProblem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserProblem  $userProblem
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserProblem $userProblem)
    {
        //
    }
}
