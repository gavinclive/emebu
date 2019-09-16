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
            'fullname' => 'Admin',
            'status' => 'active',
            'last_login' => \Carbon\Carbon::now(),
        	'created_at' => \Carbon\Carbon::now(),
        	'updated_at' => \Carbon\Carbon::now(),
        	]);
    }
}
