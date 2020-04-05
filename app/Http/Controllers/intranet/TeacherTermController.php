<?php

namespace App\Http\Controllers\intranet;

use App\Term;
use App\Topic;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TeacherTermController extends Controller
{
    public function index(Topic $topic)
    {
        $terms = Term::where('topic_id', $topic->id)->with('topic')->get();
        return view('intranet.term.index', compact('terms', 'topic'));
    }

    public function create(Topic $topic)
    {
        $topics = $topic;
        return view('intranet.term.create', compact('topics'));
    }

    public function store(Request $request)
    {
        $term = new Term();
        $term->fill($request->all());
        $term->save();

        return redirect(route('term.index'))->with('success', 'Elemento creado correctamente');
    }

    public function show(term $resource)
    {
        $edit = 0;
        $topics = Topic::where('isActive', true)->get();
        return view('intranet.term.edit', compact('term', 'edit', 'topics'));
    }

    public function edit(term $term)
    {
        $edit = 1;
        $topics = Topic::where('isActive', true)->get();
        return view('intranet.term.edit', compact('term', 'topics', 'edit'));
    }

    public function update(Request $request, term $term)
    {
        $term->fill($request->all());
        $term->save();

        return redirect(route('term.index'))->with('success', 'Elemento editado correctamente');
    }

    public function destroy(term $term)
    {
        $term->topics()->dissociate();;
        $term->save();
        $term->delete();
        return redirect(route('term.index'))->with('success', 'Elemento borrado correctamente.');
    }
}
