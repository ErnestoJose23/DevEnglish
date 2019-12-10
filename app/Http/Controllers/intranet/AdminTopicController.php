<?php

namespace App\Http\Controllers\intranet;

use App\topic;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\UploadMediaService;

class AdminTopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $topics = Topic::with('media')->get();
        return view('intranet.topic.index', compact('topics'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('intranet.topic.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $topic = new Topic();
        $topic->fill($request->all());
        if($request->hasfile('media')){
            $uploadmedia = (new UploadMediaService)->updateImg($request);
            $topic->media_id = $uploadmedia;
        }
        $topic->save();
        return redirect(route('topic.index'))->with('success', 'Temario creado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function show(topic $topic)
    {
        return view('intranet.topic.show', compact('topic'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function edit(topic $topic)
    {
        return view('intranet.topic.edit', compact('topic'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, topic $topic)
    {
        $topic->fill($request->all());
        if($request->hasfile('media')){
            $uploadmedia = (new UploadMediaService)->updateImg($request);
        }
        $topic->media_id = $uploadmedia;
        $topic->save();
        return back()
            ->with('success','Temario editado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function destroy(topic $topic)
    {
        $topic->delete();
        return redirect(route('topic.index'))->with('success', 'Tenario borrado correctamente.');
    }

}
