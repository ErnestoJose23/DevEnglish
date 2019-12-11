<?php

use Illuminate\Database\Seeder;

class ProblemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('problems')->insert([
            'problem_type_id' => 2,
            'title' => 'Listening 1',
            'content' => 'Prueba listening',
            'active' => 1,
            'topic_id' => 1,
            'token' =>Str::random(10),
        ]); 

        DB::table('problems')->insert([
            'problem_type_id' => 1,
            'title' => 'Test 1',
            'content' => 'Prueba Test',
            'active' => 1,
            'topic_id' => 1,
            'token' =>Str::random(10),
        ]); 

    }
}
