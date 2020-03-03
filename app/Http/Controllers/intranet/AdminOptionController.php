<?php

namespace App\Http\Controllers\intranet;

use App\Option;
use App\Question; 
use App\Problem;
use App\Topic;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminOptionController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $option = new Option();
        $option->option = $request->option;
        $option->question_id = $request->question_id;
        $option->correct = $request->correct;
        $problem = $request->problem_id;
        $option->save();

        return redirect(route('problem.edit', $request->problem_id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Option $option)
    {
        $option->fill($request->all());
        $option->save();
        return back()
            ->with('success', 'Elemento editado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function destroy(Option $option)
    {
        $option->delete();

        return back()
            ->with('success', 'Elemento eliminado correctamente');
    }
}
