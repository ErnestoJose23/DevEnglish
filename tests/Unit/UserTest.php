<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
use App\Http\Controllers\UserController;
use App\UserType;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class UserTest extends TestCase
{
    use WithFaker;

    /** @test */
    public function user_can_update_profile(){
        $user_type = factory(UserType::class)->create();
        Storage::fake('avatars');

        $user = factory(User::class)->create();
        $this->be($user);
        $request = new \Illuminate\Http\Request();

        $request->replace(['name' =>  $this->faker->name,  'email' => $this->faker->unique()->safeEmail, 'avatar' => UploadedFile::fake()->image('avatar.jpg')]);

        $controller = new UserController();
        $response = $controller->update($request, $user);
        $this->assertDatabaseHas('users', ['name' => $request->name, 'email' => $request->email]);
        Storage::disk('avatars')->assertExists('avatar.jpg');
    }

    /** @test */
    public function it_can_update_user(){
        $user_type = factory(UserType::class)->create();
        $user = factory(User::class)->create();

        $request = Request::create('/user', 'POST',[
            'name' =>  $this->faker->word(),
        ]);

        $controller = new AdminUserController();
        $response = $controller->update($request, $user);

        $this->assertDatabaseHas('users', ['name' => $request->name]);

    }

    /** @test */
    public function it_can_delete_user()
    {
        $user_type = factory(UserType::class)->create();
        $user = factory(User::class)->create();
        
        $controller = new AdminUserController();
        $response = $controller->destroy($user);
        
        $this->assertSoftDeleted('users', ['id' => $topic->id]);
    }

    /** @test */
    public function it_can_create_user(){
        $user_type = factory(UserType::class)->create();
        $controller = new AdminUserController();
        
        $request = Request::create('/user', 'POST',[
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'user_type_id' => 2,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);

        $response = $controller->store($request);

        $this->assertDatabaseHas('users', ['name' => $request->name]);
        $this->assertDatabaseHas('users', ['email' => $request->email]);
    }

}
