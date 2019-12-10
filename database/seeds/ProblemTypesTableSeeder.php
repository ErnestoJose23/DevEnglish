<?php

use Illuminate\Database\Seeder;

class ProblemTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('problem_types')->insert([
            'type' => 'Tipo test',
        ]); 
        DB::table('problem_types')->insert([
            'type' => 'Listening',
        ]); 
        DB::table('problem_types')->insert([
            'type' => 'Rellenar hueco',
        ]); 
        DB::table('problem_types')->insert([
            'type' => 'Encontrar fallo',
        ]); 
    }
}
