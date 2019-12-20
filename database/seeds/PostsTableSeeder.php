<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([
            'title' => 'Post 1',
            'content' => 'Esto es un post',
            'active' => 1,
            'user_id' => 1, 
            'token' =>Str::random(10),
            'created_at' => now()
        ]); 
    }
}
