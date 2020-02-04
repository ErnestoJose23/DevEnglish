<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Http\Request;
use App\Http\Controllers\Intranet\AdminTopicController;
use App\Topic;

class TopicTest extends TestCase
{
    use WithFaker;

    /** @test */
    public function it_can_update_topic(){

        $topic = factory(Topic::class)->create();

        $request = Request::create('/test/resultado', 'POST',[
            'name' =>  $this->faker->word(),
        ]);

        $controller = new AdminTopicController();
        $response = $controller->update($request, $topic);

        $this->assertDatabaseHas('topics', ['name' => $request->name]);

    }

    /** @test */
    public function it_can_delete_topic()
    {
        $topic = factory(Topic::class)->create();
        
        $controller = new AdminTopicController();
        $response = $controller->destroy($topic);
        
        $this->assertSoftDeleted('topics', ['id' => $topic->id]);
    }

    /** @test */
    public function it_can_create_topic(){
        
        $controller = new AdminTopicController();
        
        $request = Request::create('/topic', 'POST',[
            'name' =>  $this->faker->word(),
            'isActive' => rand(0, 1),
            'avatar' => $this->faker->word(),
        ]);

        $response = $controller->store($request);

        $this->assertDatabaseHas('topics', ['name' => $request->name]);
        $this->assertDatabaseHas('topics', ['avatar' => $request->avatar]);

    }
}
