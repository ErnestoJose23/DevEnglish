<?php

namespace App\Http\Controllers\intranet;

use Auth;
use App\Term;
use App\Topic;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminTermController extends Controller
{
    public function index()
    {
        $terms = Term::with('topic')->get();
        return view('intranet.term.index', compact('terms'));
    }

    public function create()
    {
        $topics = Topic::where('active', true)->get();
        return view('intranet.term.create', compact('topics'));
    }

    public function store(Request $request)
    {   
        $term = new Term();
        $term->fill($request->all());
        $term->save();
        if(Auth::user()->isAdmin()) 
            return redirect(route('term.index'))->with('success', 'Elemento creado correctamente');
        else{
            
            $term = Term::where('topic_id', $term->id)->with('topic')->get();
            return view('intranet.term.index', compact('resources', 'topic'));
        }
        
    }
}