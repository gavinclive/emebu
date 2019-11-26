<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        DB::table('users')->insert([
            'email' => 'admin@es.com',
            'password' => bcrypt('admin'),
            'role' => '2',
            'name' => 'Admin',
            'status' => 'active',
            'last_login' => Carbon::now(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('users')->insert([
        	'email' => 'eo@es.com',
            'password' => bcrypt('eo'),
            'role' => '3',
            'name' => 'Organizer Keren',
            'status' => 'active',
            'bank' => $faker->company,
            'acc_number' => $faker->bankAccountNumber,
            'last_login' => Carbon::now(),
        	'created_at' => Carbon::now(),
        	'updated_at' => Carbon::now(),
        ]);

        DB::table('users')->insert([
        	'email' => 'premium@es.com',
            'password' => bcrypt('premium'),
            'role' => '4',
            'name' => 'Organizer Premium',
            'status' => 'active',
            'bank' => $faker->company,
            'acc_number' => $faker->bankAccountNumber,
            'last_login' => Carbon::now(),
        	'created_at' => Carbon::now(),
        	'updated_at' => Carbon::now(),
        ]);
            
        DB::table('users')->insert([
            'email' => 'ucok@es.com',
            'password' => bcrypt('ucok'),
            'role' => '1',
            'name' => 'Ucok H',
            'status' => 'active',
            'last_login' => Carbon::now(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        foreach(range(0, 20) as $i) {
            DB::table('users')->insert([
                'name' =>  $i % 2 == 0 ? $faker->name : $faker->company,
                'email' => $faker->email,
                'password' => bcrypt('secret'),
                'role' => '1',
                'status' =>  'active',
                'bank' => $i % 2 == 0 ? NULL : $faker->company,
                'acc_number' => $i % 2 == 0 ? NULL : $faker->bankAccountNumber,
                'last_login' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'image' => $faker->imageUrl(125, 125)
            ]);
        }
    }
}
