<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Services\SendEmail;

class ContactController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sendMail = (new SendEmail)->contactUs($request);
        return back();
    }
}