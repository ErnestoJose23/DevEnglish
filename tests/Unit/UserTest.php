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

}
