<?php

use Illuminate\Database\Seeder;

class OptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('options')->insert([
            'question_id' => 1,
            'option' => 'Opcion 1',
            'correct' => 0,
        ]); 
        DB::table('options')->insert([
            'question_id' => 1,
            'option' => 'Opcion 2',
            'correct' => 1,
        ]); 
        DB::table('options')->insert([
            'question_id' => 1,
            'option' => 'Opcion 3',
            'correct' => 0,
        ]); 
        DB::table('options')->insert([
            'question_id' => 1,
            'option' => 'Opcion 4',
            'correct' => 0,
        ]); 

        DB::table('options')->insert([
            'question_id' => 2,
            'option' => 'Opcion 1',
            'correct' => 0,
        ]); 
        DB::table('options')->insert([
            'question_id' => 2,
            'option' => 'Opcion 2',
            'correct' => 0,
        ]); 
        DB::table('options')->insert([
            'question_id' => 2,
            'option' => 'Opcion 3',
            'correct' => 0,
        ]); 
        DB::table('options')->insert([
            'question_id' => 2,
            'option' => 'Opcion 4',
            'correct' => 1,
        ]); 

        DB::table('options')->insert([
            'question_id' => 3,
            'option' => 'Opcion 1',
            'correct' => 1,
        ]); 
        DB::table('options')->insert([
            'question_id' => 3,
            'option' => 'Opcion 2',
            'correct' => 0,
        ]); 
        DB::table('options')->insert([
            'question_id' => 3,
            'option' => 'Opcion 3',
            'correct' => 0,
        ]); 
        DB::table('options')->insert([
            'question_id' => 3,
            'option' => 'Opcion 4',
            'correct' => 0,
        ]); 

        DB::table('options')->insert([
            'question_id' => 4,
            'option' => 'Opcion 1',
            'correct' => 0,
        ]); 
        DB::table('options')->insert([
            'question_id' => 4,
            'option' => 'Opcion 2',
            'correct' => 1,
        ]); 
        DB::table('options')->insert([
            'question_id' => 4,
            'option' => 'Opcion 3',
            'correct' => 0,
        ]); 
        DB::table('options')->insert([
            'question_id' => 4,
            'option' => 'Opcion 4',
            'correct' => 0,
        ]); 

        DB::table('options')->insert([
            'question_id' => 5,
            'option' => 'Opcion 1',
            'correct' => 0,
        ]); 
        DB::table('options')->insert([
            'question_id' => 5,
            'option' => 'Opcion 2',
            'correct' => 0,
        ]); 
        DB::table('options')->insert([
            'question_id' => 5,
            'option' => 'Opcion 3',
            'correct' => 0,
        ]); 
        DB::table('options')->insert([
            'question_id' => 5,
            'option' => 'Opcion 4',
            'correct' => 1,
        ]); 

        DB::table('options')->insert([
            'question_id' => 6,
            'option' => 'Opcion 1',
            'correct' => 1,
        ]); 
        DB::table('options')->insert([
            'question_id' => 6,
            'option' => 'Opcion 2',
            'correct' => 0,
        ]); 
        DB::table('options')->insert([
            'question_id' => 6,
            'option' => 'Opcion 3',
            'correct' => 0,
        ]); 
        DB::table('options')->insert([
            'question_id' => 6,
            'option' => 'Opcion 4',
            'correct' => 0,
        ]); 
    }
}
