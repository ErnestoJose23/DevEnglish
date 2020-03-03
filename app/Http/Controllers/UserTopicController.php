<?php

namespace App\Http\Controllers;

use App\UserTopic;
use APp\User;
use Illuminate\Http\Request;

class UserTopicController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $subscription = new UserTopic();
        $subscription->fill($request->all());
        $subscription->save();
        $user = User::where('id', $request->user_id)->first();

        if($user->user_type_id == 2)    return back()->with('success', 'Profesor asignado con exito');
        
        return back()->with('success', 'Te has suscrito al temario '.$request->name.'');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserTopic $subscription)
    {
        $subscription->delete();
        return back()->with('success', 'Subscripción cancelada correctamente.');
    }
}
