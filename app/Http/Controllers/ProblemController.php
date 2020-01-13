<?php

namespace App\Http\Controllers;

use App\Problem;
use App\Topic;
use App\Question;
use App\Option;
use App\UserProblem;
use App\UserTopic;
use Illuminate\Http\Request;

class ProblemController extends Controller
{
    public function Index(){
        $topics = Topic::where('isActive', true)->with('subscriptions')->get();
        return $topics;
        return view('pruebas', compact('topics'));

    }

    public function show(Problem $problem){ 
        if($problem->display == 1)
            $questions = Question::where('problem_id', $problem->id)->with('options')->get();
        else
            $questions = Question::where('problem_id', $problem->id)->inRandomOrder()->with('options')->get();
        switch($problem->problem_type_id){
            case 1:
                return view('pruebas.test.index', compact('problem', 'questions')); 
                break;
            case 2:
                return view('pruebas.listening.index', compact('problem', 'questions')); 
                break;
            case 3:
                return view('pruebas.hueco.index', compact('problem', 'questions')); 
                break;
            case 4:
                return view('pruebas.fallo.index', compact('problem', 'questions')); 
                break;
        }
    }

    public function indexPruebas(Topic $topic){  
        if(UserTopic::subscribed($topic)){
            $tests = $problems = Problem::where('isActive', true)->where('problem_type_id', 1)->where('topic_id', $topic->id)->get();
            $listenings = $problems = Problem::where('isActive', true)->where('problem_type_id', 2)->where('topic_id', $topic->id)->get();
            $huecos = $problems = Problem::where('isActive', true)->where('problem_type_id', 3)->where('topic_id', $topic->id)->get();
            $fallos = $problems = Problem::where('isActive', true)->where('problem_type_id', 4)->where('topic_id', $topic->id)->get();
            return view('pruebas.index', compact('tests', 'listenings', 'huecos', 'fallos'));
        }else
            return back();
    }

    public function getPruebas(Topic $topic, int $type){
        $problems = Problem::where('isActive', true)->where('problem_type_id', $type)->where('topic_id', $topic->id)->with('problem_type')->paginate(10);
        return view('pruebas.problems', compact('problems', 'topic'));
    }
}
