<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Topic;
use App\Problem;
use App\Question;
use App\UserProblem;
use Illuminate\Http\Request;

class PruebasController extends Controller
{
    public function Index(){
       
        $topics = Topic::where('active', true)->get();
        return view('pruebas', compact('topics'));

    }

    public function getPruebas(Topic $topic){   
        return view('pruebas.index', compact('topic'));
    }

    public function getAllTests(Topic $topic){   
        $problems = Problem::where('active', true)->where('type',1)->where('topic_id', $topic->id)->get();
        $type = "Test";
        $type_route = 1;
        return view('pruebas.test', compact('problems', 'type', 'type_route'));
    }

    public function getTest(Problem $problem){
        $questions = Question::where('problem_id', $problem->id)->inRandomOrder()->get();
        return view('pruebas.test.index', compact('problem', 'questions'));
    }

    public function realizarTest(Request $request){
        $cont = 0;
        $questions = $request->questions;
        for($i=1;$i<$questions + 1; $i++){  
            if($request->$i == 1) $cont++;
        }
        $UserProblem = new UserProblem();
        $UserProblem->user_id = $request->user_id;
        $UserProblem->problem_id = $request->problem_id;
        $UserProblem->options = $questions;
        $UserProblem->success = $cont;
        $UserProblem->save();
        return view('pruebas.test.resultado', compact('questions', 'cont'));

    }

    public function getAllListenings(Topic $topic){
        $problems = Problem::where('active', true)->where('tipe',4)->where('topic_id', $topic->id)->get();
        $type = "Listening";
        $type_route = 4;
        return view('pruebas.test', compact('problems', 'type', 'type_route'));
    }

    public function getListening(Problem $problem){
        $questions = Question::where('problem_id', $problem->id)->inRandomOrder()->get();
        return view('pruebas.listening.index', compact('problem', 'questions'));
    }
}
