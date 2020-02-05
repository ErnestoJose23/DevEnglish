<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Http\Request;
use App\Http\Controllers\Intranet\AdminProblemController;
use App\Problem;
use App\ProblemType;

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

        $this->assertDatabaseHas('Problems', ['title' => $request->title]);

    }

    /** @test */
    public function it_can_delete_problem()
    {
        $problem_type = factory(ProblemType::class)->create();
        $problem = factory(Problem::class)->create();
        
        $controller = new AdminProblemController();
        $response = $controller->destroy($problem);
        
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
        ]);

        $response = $controller->store($request);

        $this->assertDatabaseHas('Problems', ['title' => $request->title]);
        $this->assertDatabaseHas('Problems', ['content' => $request->content]);

    }

}