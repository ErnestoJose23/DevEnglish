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
    public function index()
    {
        $topics = Topic::with('subscriptions.user')->get();
        return view('intranet.topic.index', compact('topics'));
    }

    public function create()
    {
        return view('intranet.topic.create');
    }

    public function store(Request $request)
    {
        $topic = new Topic();
        $topic->fill($request->all());
        if($request->hasfile('avatar')){
            $uploadmedia = (new UploadMediaService)->updateImg($request);
            $topic->media_id = $uploadmedia;
        }
        $topic->save();
        return redirect(route('topic.index'))->with('success', 'Temario creado correctamente');
    }

    public function show(topic $topic)
    {
        $edit = 0;
        return view('intranet.topic.edit', compact('topic', 'edit'));
    }

    public function edit(topic $topic)
    {
        $edit = 1;
        return view('intranet.topic.edit', compact('topic', 'edit'));
    }

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
