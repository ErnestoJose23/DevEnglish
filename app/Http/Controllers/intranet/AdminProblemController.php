<?php

namespace App\Http\Controllers\intranet;

use App\Problem;
use App\Topic;
use App\Question;
use App\Option;
use App\Media;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminProblemController extends Controller
{
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $problems = Problem::with('topic')->get();
        return view('intranet.problem.index', compact('problems'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $topics = Topic::where('active', true)->get();
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
        if($request->hasfile('file')){
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            $filename= time() . '.' . $extension;
            $file->move('uploads/problem/', $filename);
            $problem->file = $filename;
        }else{
            $problem->file = 'default.jpg';
        }
        $problem->save();

        return redirect(route('problem.index'))->with('success', 'Elemento creado correctamente');
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
        $media = Media::where('remember_token', $request->remember_token)->first();
        if($media == NULL) $media = new Media();
        if($request->audio != NULL){
            $file = $request->file('audio');
            $extension = $file->getClientOriginalExtension();
            $filename= time() . '.' . $extension;
            $file->move('uploads/media/', $filename);
            $media->archive = $filename;
            $media->extention =  $file->getClientOriginalExtension();
            $media->remember_token = $request->remember_token; 
        }
        $media->save();

        $topics = Topic::where('active', true)->get();

        //Llamar a la ruta del edit
        return back()
            ->with('Elemento editado correctamente');
    }

}
