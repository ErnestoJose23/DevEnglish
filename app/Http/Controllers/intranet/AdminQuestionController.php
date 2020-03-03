<?php

namespace App\Http\Controllers\intranet;

use App\Question;
use App\Problem;
use App\Topic;
use App\Option;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminQuestionController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $question = new Question();
        $question->fill($request->all());
        $question->save();
        return redirect(route('problem.edit', $request->problem_id));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        $question->fill($request->all());
        $question->save();
        return back()
            ->with('success','Pregunta editada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        $question->delete();

        return redirect( route('problem.edit', $question->problem_id) )->with('success', 'Pregunta eliminada correctamente');
    }
}
