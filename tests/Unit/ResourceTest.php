<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Http\Request;
use App\Http\Controllers\Intranet\AdminResourceController;
use App\Resource;
use App\User;
use App\UserType;

class ResourceTest extends TestCase
{
    use WithFaker;

    /** @test */
    public function it_can_update_resource(){

        $Resource = factory(Resource::class)->create();

        $request = Request::create('/resource', 'POST',[
            'title' =>  $this->faker->word(),
            'url' => $this->faker->url,
            'description' => $this->faker->text,
        ]);

        $controller = new AdminResourceController();
        $response = $controller->update($request, $Resource);
        $this->assertDatabaseHas('Resources', ['title' => $request->title]);

    }

    /** @test */
    public function it_can_delete_resource()
    {
        $Resource = factory(Resource::class)->create();
        
        $controller = new AdminResourceController();
        $response = $controller->destroy($Resource);
        
        $this->assertSoftDeleted('Resources', ['id' => $Resource->id]);
    }

    /** @test */
    public function it_can_create_resource(){
        $user_type = factory(UserType::class)->create();
        $user = factory(User::class)->create();
        $this->be($user);
        $controller = new AdminResourceController();
        
        $request = Request::create('/resource', 'POST',[
            'title' => $this->faker->name,
            'url' => $this->faker->url,
            'description' => $this->faker->text,
            'topic_id' => 2,
            'isActive' => $this->faker->boolean,
            'token' => $this->faker->name,
            'type' => 1
        ]);

        $response = $controller->store($request);

        $this->assertDatabaseHas('Resources', ['title' => $request->title]);
        $this->assertDatabaseHas('Resources', ['url' => $request->url]);
        $this->assertDatabaseHas('Resources', ['description' => $request->description]);
        $this->assertDatabaseHas('Resources', ['token' => $request->token]);

    }
}
