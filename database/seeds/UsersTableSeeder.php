<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => bcrypt('secret'),
            'remember_token' =>Str::random(10),
            'user_type_id' => 1,
            'active' => 1,
        ]); 
        DB::table('users')->insert([
            'name' => 'Teacher',
            'email' => 'teacher@admin.com',
            'email_verified_at' => now(),
            'password' => bcrypt('secret'),
            'remember_token' => Str::random(10),
            'user_type_id' => 2,
            'active' => 1,
        ]); 
        DB::table('users')->insert([
            'name' => 'Student',
            'email' => 'student@admin.com',
            'email_verified_at' => now(),
            'password' => bcrypt('secret'),
            'remember_token' => Str::random(10),
            'user_type_id' => 3,
            'active' => 1,
        ]); 

    }
}
