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
    public function store(Request $request)
    {
        $question = new Question();
        $question->fill($request->all());
        $question->save();
        return redirect(route('problem.edit', $request->problem_id));
    }

    public function update(Request $request, Question $question)
    {
        $question->fill($request->all());
        $question->save();
        return back()
            ->with('success','Pregunta editada correctamente.');
    }

    public function destroy(Question $question)
    {
        $question->delete();
        return redirect( route('problem.edit', $question->problem_id) )->with('success', 'Pregunta eliminada correctamente');
    }
}
