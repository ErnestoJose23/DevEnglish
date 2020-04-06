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
    public function index()
    {
        $resources = Resource::with('topic')->get();
        return view('intranet.resource.index', compact('resources'));
    }

    public function create()
    {
        $topics = Topic::where('isActive', true)->get();
        return view('intranet.resource.create', compact('topics'));
    }

    public function store(Request $request)
    {   
        $resource = new Resource();
        $resource->fill($request->all());
        $resource->token = rand();
        $resource->save();
        $topic = Topic::where('id', $request->topic_id)->first();
        $sendMail = (new SendEmail)->sendMail($resource->id, $topic->name, $request->title, 2, $topic->id);
        if(Auth::user()->isAdmin()) 
            return $sendMail;
           // return redirect(route('resource.index'))->with('success', 'Elemento creado correctamente');
        else{ 
            $resources = Resource::where('topic_id', $topic->id)->with('topic')->get();
            return view('intranet.resource.index', compact('resources', 'topic'));
        }
        
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
        $resource->save();
        return back()
            ->with('success', 'Elemento editado correctamente');
    }

    public function destroy(resource $resource)
    {
        $resource->delete();
        return redirect(route('resource.index'))->with('success', 'Elemento borrado correctamente.');
    }
}
