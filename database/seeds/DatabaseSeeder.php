<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        DB::table('users')->insert([
            'username' => 'admin',
        	'email' => 'admin@es.com',
            'password' => bcrypt('admin'),
            'role' => 1,
            'name' => 'Admin',
            'status' => 'active',
            'last_login' => \Carbon\Carbon::now(),
        	'created_at' => \Carbon\Carbon::now(),
        	'updated_at' => \Carbon\Carbon::now(),
        ]);
            
        DB::table('users')->insert([
            'username' => 'ucok_keren86',
            'email' => 'ucok@es.com',
            'password' => bcrypt('ucok'),
            'role' => 2,
            'name' => 'Ucok H',
            'status' => 'active',
            'last_login' => \Carbon\Carbon::now(),
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
    }
}
