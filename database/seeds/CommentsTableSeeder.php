<?php

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comments')->insert([
            'post_id' => 1,
            'content' => 'Comentario',
            'date' => now(),
            'user_id' => 1,
            'created_at' => now(),
            'token' =>Str::random(10)
        ]); 
    }
}
