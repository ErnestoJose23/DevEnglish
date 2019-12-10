<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class VideosController extends Controller
{
    public function Index(){
        $videos = DB::table('resources')->where('tipe', '1')->where('active','1')->get();

        return view('videos', ['videos' => $videos]);

    }

    public function showVideos($id){
        $videos = DB::table('resources')->where('tipe','1')->where('active','1')->where('topic_id', $id)->get();

        return view('videos', ['videos' => $videos]);
    }
}
