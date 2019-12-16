<?php

namespace App\Http\Controllers\intranet;

use App\Resource;
use App\Media;
use App\Topic;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $resources = Resource::with(['topic'])->get();
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
        $resource->remember_token = Str::random(10);
        if($request->hasfile('img')){
            $media = new Media();
            $file = $request->file('img');
            $extension = $file->getClientOriginalExtension();
            $filename= time() . '.' . $extension;
            $file->move('uploads/media/', $filename);
            $media->remember_token = $resource->remember_token;
            $media->archive = $filename;
            $media->extention = $extension;
            $media->save();
        }else{
            $media = new Media();
            $media->remember_token = $resource->remember_token;
            $media->archive = 'default.jpg';
            $media->extention = 'jpg';
            $media->save();
        }
        $resource->save();

        return redirect(route('resource.index'))->with('success', 'Elemento creado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\resource  $resource
     * @return \Illuminate\Http\Response
     */
    public function show(resource $resource)
    {
        return view('intranet.resource.show', compact('resource'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\resource  $resource
     * @return \Illuminate\Http\Response
     */
    public function edit(resource $resource)
    {
        $topics = Topic::where('active', true)->get();
        return view('intranet.resource.edit', compact('resource', 'topics'));
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
        if($request->img == NULL){
            $resource->img = $request->oldimag;
        }else{
            $file = $request->file('img');
            $extension = $file->getClientOriginalExtension();
            $filename= time() . '.' . $extension;
            $file->move('uploads/resource/', $filename);
            $resource->img = $filename;
        }
        $resource->save();

        return redirect(route('resource.index'))->with('success', 'Elemento editado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\resource  $resource
     * @return \Illuminate\Http\Response
     */
    public function destroy(resource $resource)
    {
        $resource->topics()->dissociate();;
        $resource->save();
        $resource->delete();
        return redirect(route('resource.index'))->with('success', 'Elemento borrado correctamente.');
    }
}
