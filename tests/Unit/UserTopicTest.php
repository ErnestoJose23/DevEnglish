<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Tests\TestCase;
use App\User;
use App\Topic;
use App\UserType;
use App\UserTopic;
use App\Http\Controllers\UserTopicController;


class UserTopicTest extends TestCase
{
    /** @test */
    public function student_subscribe_to_topic(){
        $user_type = factory(UserType::class)->create();
        $user = factory(User::class)->create();
        $this->be($user);
        $topic = factory(Topic::class)->create();

        $request = Request::create('/subscription', 'POST',[
            'topic_id' => $topic->id,
            'user_id' => $user->id,
        ]);

        $controller = new UserTopicController();
        $response = $controller->store($request);

        $this->assertDatabaseHas('user_topics', ['user_id' => $user->id]);
    }

    /** @test */
    public function student_unsubscribe_to_topic(){

        $usertopic = factory(UserTopic::class)->create();
        
        $controller = new UserTopicController();
        $response = $controller->destroy($usertopic);
        
        $this->assertSoftDeleted('user_topics', ['id' => $usertopic->id]);
    }

}
