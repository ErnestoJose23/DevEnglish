<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Tests\TestCase;
use App\User;
use App\Topic;
use App\Problem;
use App\UserType;
use App\ProblemType;
use App\Http\Controllers\UserProblemController;


class UserProblemTest extends TestCase
{
    
    

    /** @test */
    public function student_do_a_test(){
        $user_type = factory(UserType::class)->create();
        $user = factory(User::class)->create();
        $this->be($user);
        $topic = factory(Topic::class)->create();
        $problem_type = factory(ProblemType::class)->create();
        $problem = factory(Problem::class)->create();

        $request = Request::create('/test/resultado', 'POST',[
            'cont' => 10,
            'right' => rand(1, 10),
            'topic_id' => $topic->id,
            'problem_id' => $problem->id
        ]);

        $controller = new UserProblemController();
        $response = $controller->store($request);

        $this->assertDatabaseHas('user_problems', ['user_id' => $user->id]);
    }

}
