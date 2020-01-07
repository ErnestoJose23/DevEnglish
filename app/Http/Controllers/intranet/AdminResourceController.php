<?php

namespace App\Http\Controllers\intranet;

use Auth;
use App\Resource;
use App\Media;
use App\Topic;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Services\UploadMediaService;
use App\Services\SendEmail;

class AdminResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $resources = Resource::with('topic')->get();
        return view('intranet.resource.index', compact('resources'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $topics = Topic::where('active', true)->get();
        return view('intranet.resource.create', compact('topics'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $resource = new Resource();
        $resource->fill($request->all());
        if($request->hasfile('filename')){
            $image = (new UploadMediaService)->uploadImages($request);
        }
        $resource->token = $request->token;
        $resource->save();
        $topic = Topic::where('id', $request->topic_id)->first();
        $type = 2;
        $sendMail = (new SendEmail)->sendMail($resource->id, $topic->name, $request->title, $type, $topic->id);
        if(Auth::user()->isAdmin()) 
            return redirect(route('resource.index'))->with('success', 'Elemento creado correctamente');
        else{
            
            $resources = Resource::where('topic_id', $topic->id)->with('topic')->get();
            return view('intranet.resource.index', compact('resources', 'topic'));
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\resource  $resource
     * @return \Illuminate\Http\Response
     */
    public function show(resource $resource)
    {
        $edit = 0;
        $topics = Topic::where('active', true)->get();
        return view('intranet.resource.edit', compact('resource', 'edit', 'topics'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\resource  $resource
     * @return \Illuminate\Http\Response
     */
    public function edit(resource $resource)
    {
        $edit = 1;
        $topics = Topic::where('active', true)->get();
        return view('intranet.resource.edit', compact('resource', 'topics', 'edit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\resource  $resource
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, resource $resource)
    {
        $resource->fill($request->all());
        if($request->hasfile('filename')){
            $image = (new UploadMediaService)->uploadImages($request);
        }
        $resource->save();
        return back()
            ->with('success', 'Elemento editado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\resource  $resource
     * @return \Illuminate\Http\Response
     */
    public function destroy(resource $resource)
    {
        $resource->delete();
        return redirect(route('resource.index'))->with('success', 'Elemento borrado correctamente.');
    }
}
