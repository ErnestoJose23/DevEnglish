<?php

use Illuminate\Database\Seeder;

class UserTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('user_types')->insert([
            'type' => 'Admin',
        ]); 
        DB::table('user_types')->insert([
            'type' => 'Teacher',
        ]); 
        DB::table('user_types')->insert([
            'type' => 'Student',
        ]); 
        
    }
}


