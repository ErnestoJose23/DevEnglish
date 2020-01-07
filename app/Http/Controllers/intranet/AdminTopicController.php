<?php

namespace App\Http\Controllers\intranet;

use App\topic;
use App\UserTopic;
use App\User;
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
        $topics = Topic::with('subscriptions.user')->get();
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
        $edit = 0;
        return view('intranet.topic.edit', compact('topic', 'edit'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function edit(topic $topic)
    {
        $edit = 1;
        return view('intranet.topic.edit', compact('topic', 'edit'));
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
        if($request->hasfile('avatar')){
            $topic->avatar = (new UploadMediaService)->updateImg($request);
        }
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
        $filename = public_path().'/uploads/media/'.$topic->avatar;
        \File::delete($filename);
        $topic->avatar = null;
        $topic->delete();
        return redirect(route('topic.index'))->with('success', 'Tenario borrado correctamente.');
    }

    public function deleteImage(topic $topic){
        $filename = public_path().'/uploads/media/'.$topic->avatar;
        \File::delete($filename);
        $topic->avatar = null;
        $topic->save();
        return back()
            ->with('success', 'Imagen eliminada con exito');
    }

    public function getUnassigned(int $topic_id){
        $assigned = UserTopic::where('topic_id', $topic_id)->get();
        $teacherAssigned = [];
        foreach($assigned as $i){
            $teacherAssigned[] += $i->user_id;
        }
        return User::where('user_type_id', 2) ->whereNotIn('id',$teacherAssigned)->get();
    }

}
