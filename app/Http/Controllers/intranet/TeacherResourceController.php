<?php

namespace App\Http\Controllers\intranet;

use App\Resource;
use App\Media;
use App\Topic;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Services\UploadMediaService;

class TeacherResourceController extends Controller
{

    public function index(Topic $topic)
    {
        $resources = Resource::where('topic_id', $topic->id)->with('topic')->get();
        return view('intranet.resource.index', compact('resources', 'topic'));
    }

    public function create(Topic $topic)
    {
        $topics = $topic;
        return view('intranet.resource.create', compact('topics'));
    }

    public function store(Request $request)
    {
        $resource = new Resource();
        $resource->fill($request->all());
        if($request->hasfile('filename')){
            $image = (new UploadMediaService)->uploadImages($request);
        }
        $resource->token = $request->token;
        $resource->save();

        return redirect(route('resource.index'))->with('success', 'Elemento creado correctamente');
    }

    public function show(resource $resource)
    {
        $edit = 0;
        $topics = Topic::where('isActive', true)->get();
        return view('intranet.resource.edit', compact('resource', 'edit', 'topics'));
    }

    public function edit(resource $resource)
    {
        $edit = 1;
        $topics = Topic::where('isActive', true)->get();
        return view('intranet.resource.edit', compact('resource', 'topics', 'edit'));
    }

    public function update(Request $request, resource $resource)
    {
        $resource->fill($request->all());
        if($request->hasfile('filename')){
            $image = (new UploadMediaService)->uploadImages($request);
        }
        $resource->save();

        return redirect(route('resource.index'))->with('success', 'Elemento editado correctamente');
    }

    public function destroy(resource $resource)
    {
        $resource->topics()->dissociate();;
        $resource->save();
        $resource->delete();
        return redirect(route('resource.index'))->with('success', 'Elemento borrado correctamente.');
    }
}
