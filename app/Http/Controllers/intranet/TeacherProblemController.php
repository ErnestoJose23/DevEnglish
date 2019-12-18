<?php

namespace App\Http\Controllers\intranet;

use App\Problem;
use App\Topic;
use App\Question;
use App\Option;
use App\Media;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\UploadMediaService;

class TeacherProblemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Topic $topic)
    {
        $problems = Problem::where('topic_id', $topic->id)->with('topic', 'problem_type')->get();
        return view('intranet.problem.index', compact('problems', 'topic'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Topic $topic)
    {
        $topics = $topic;

        return view('intranet.problem.create', compact('topics'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $problem = new Problem();
        $problem->fill($request->all());
        $problem->token = Str::random(10);
        $problem->save();
        return redirect(route('problem.edit', $problem))->with('success', 'Elemento creado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Problem  $problem
     * @return \Illuminate\Http\Response
     */
    public function show(Problem $problem)
    {
        return view('intranet.problem.show', compact('problem'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Problem  $problem
     * @return \Illuminate\Http\Response
     */
    public function edit(Problem $Problem)
    {
        $problem = Problem::where('id', $Problem->id)->with('questions.options')->first();
        $topics = Topic::where('active', true)->get();
        return view('intranet.problem.edit', compact('problem', 'topics'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Problem  $problem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Problem $problem)
    {

        $problem->fill($request->all());
        $problem->save();
        return back()
            ->with('success', 'Elemento editado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Problem  $problem
     * @return \Illuminate\Http\Response
     */
    public function destroy(Problem $problem)
    {
        $problem->delete();
        return redirect(route('problem.index'))->with('success', 'Elemento borrado correctamente.');
    }

    public function storefile(Request $request){
        $uploadmedia = (new UploadMediaService)->updateAudio($request);
        return back()
            ->with('Elemento editado correctamente');
    }

}
