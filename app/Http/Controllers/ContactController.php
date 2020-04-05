<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Services\SendEmail;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $sendMail = (new SendEmail)->contactUs($request);
        return back();
    }
}