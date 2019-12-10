<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class LinksController extends Controller
{
    public function Index(){
        $links = DB::table('resources')->where('tipe', '2')->where('active','1')->get();

        return view('links', ['links' => $links]);

    }

    public function showLinks($id){
        $links = DB::table('resources')->where('tipe','2')->where('active','1')->where('topic_id', $id)->get();

        return view('links', ['links' => $links]);
    }

}
