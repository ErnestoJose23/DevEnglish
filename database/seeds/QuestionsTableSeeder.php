<?php

use Illuminate\Database\Seeder;

class QuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('questions')->insert([
            'problem_id' => 1,
            'title' => 'Primera pregunta',
        ]); 
        DB::table('questions')->insert([
            'problem_id' => 1,
            'title' => 'Segunda pregunta',
        ]); 
        DB::table('questions')->insert([
            'problem_id' => 1,
            'title' => 'Tercera pregunta',
        ]); 
        DB::table('questions')->insert([
            'problem_id' => 2,
            'title' => 'Primera pregunta 1',
        ]); 
        DB::table('questions')->insert([
            'problem_id' => 2,
            'title' => 'Segunda pregunta 1',
        ]); 
        DB::table('questions')->insert([
            'problem_id' => 2,
            'title' => 'Tercera pregunta 1',
        ]); 
    }
}
