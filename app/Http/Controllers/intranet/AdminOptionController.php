<?php

namespace App\Http\Controllers\intranet;

use App\Option;
use App\Question; 
use App\Problem;
use App\Topic;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminOptionController extends Controller
{
    public function store(Request $request)
    {
        $option = new Option();

        $option->fill($request->all());
        $option->save();

        return redirect(route('problem.edit', $request->problem_id));
    }

    public function update(Request $request, Option $option)
    {
        $option->fill($request->all());
        $option->save();
        return back()
            ->with('success', 'Elemento editado correctamente');
    }

    public function destroy(Option $option)
    {
        $option->delete();
        return back()
            ->with('success', 'Elemento eliminado correctamente');
    }
}
