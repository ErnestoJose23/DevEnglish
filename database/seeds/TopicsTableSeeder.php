<?php

use Illuminate\Database\Seeder;

class TopicsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('topics')->insert([
            'name' => 'FrontEnd',
            'isActive' => 1,
        ]); 

        DB::table('topics')->insert([
            'name' => 'BackEnd',
            'isActive' => 1,
        ]); 
    }
}
