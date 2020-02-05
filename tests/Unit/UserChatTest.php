<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Tests\TestCase;
use App\User;
use App\UserType;
use App\Chat;
use App\Topic;
use App\Http\Controllers\ChatController;


class UserChatTest extends TestCase
{
    use WithFaker;
    /** @test */
    public function student_create_chat(){
        $user_type = factory(UserType::class)->create();
        $user = factory(User::class)->create();
        $this->be($user);
        $topic = factory(Topic::class)->create();

        $request = Request::create('/consulta', 'POST',[
            'title' =>  $this->faker->word(),
            'content' =>  $this->faker->text(),
            'topic_id' => $topic->id,
            'token' => $this->faker->name,
        ]);

        $controller = new ChatController();
        $response = $controller->store($request);

        $this->assertDatabaseHas('chats', ['title' => $request->title]);
    }

}
