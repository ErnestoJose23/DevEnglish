<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Problem;

class ProblemTest extends TestCase
{
    use WithFaker;

    /** @test */
    public function it_can_update_problem(){
        $problem_type = factory(ProblemType::class)->create();
        $problem = factory(Problem::class)->create();

        $request = Request::create('/problem', 'POST',[
            'title' => $this->faker->name,
            'content' => $this->faker->word,
        ]);

        $controller = new AdminProblemController();
        $response = $controller->update($request, $problem);

        $this->assertDatabaseHas('Problems', ['name' => $request->name]);

    }

    /** @test */
    public function it_can_delete_problem()
    {
        $problem_type = factory(ProblemType::class)->create();
        $problem = factory(Problem::class)->create();
        
        $controller = new AdminProblemController();
        $response = $controller->destroy($Problem);
        
        $this->assertSoftDeleted('problems', ['id' => $problem->id]);
    }

    /** @test */
    public function it_can_create_problem(){
        $problem_type = factory(ProblemType::class)->create();
        $controller = new AdminProblemController();
        
        $request = Request::create('/problem', 'POST',[
            'title' => $this->faker->name,
            'problem_type_id' =>  2,
            'content' => $this->faker->word,
            'isActive' => 1,
            'topic_id' => 2,
            'token' => $this->faker->word,
        ]);

        $response = $controller->store($request);

        $this->assertDatabaseHas('Problems', ['title' => $request->title]);
        $this->assertDatabaseHas('Problems', ['content' => $request->content]);
        $this->assertDatabaseHas('Problems', ['token' => $request->token]);

    }

}