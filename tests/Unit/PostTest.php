<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\DuskTestCase;
use Laravel\Dusk\Chrome;
use Illuminate\Support\Str;
use App\User;

class PostTest extends TestCase
{
    //use RefreshDatabase;

     /** @test */
    public function user_create_a_post(){
        $user = factory(User::class)->create();
        $this->be($user);

        $this->browse(function ($browser) use ($user) {
            $browser->visit('/forum')
                    ->type('title', Str::random(10))
                    ->type('content', Str::random(30))
                    ->press('SubmitPost')
                    ->assertDatabaseHas('posts', ['user_id' => $user->id]);
        });

    }

}