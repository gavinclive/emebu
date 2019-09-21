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

        $ArrType = [
        [
            'name' => 'Atraksi',
            'image'=> 'https://images.unsplash.com/photo-1464059728276-d877187d61a9?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&h=250'
        ],
        [
            'name'=> 'Balapan',
            'image'=> 'https://images.pexels.com/photos/12795/pexels-photo-12795.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=250'
        ],
        [
            'name' => 'Kelas',
            'image'=> 'https://images.pexels.com/photos/265076/pexels-photo-265076.jpeg?auto=format%2Ccompress&cs=tinysrgb&dpr=2&h=250'
        ],
        [
            'name' => 'Konferensi',
            'image' => 'https://images.unsplash.com/photo-1505373877841-8d25f7d46678?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&h=250'
        ],
        [
            'name' => 'Konvensi',
            'image' => 'https://images.unsplash.com/photo-1560964598-dee5d2b9dd6b?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&h=250'
        ],
        [
            'name' => 'Festival',
            'image' => 'https://images.unsplash.com/photo-1520483691742-bada60a1edd6?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&h=250'
        ],
        [
            'name' => 'Gala',
            'image' => 'https://images.unsplash.com/photo-1516997121675-4c2d1684aa3e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&h=250'
        ],
        [
            'name' => 'Jaringan',
            'image' => 'https://images.unsplash.com/photo-1545987796-200677ee1011?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&h=250'
        ],
        [
            'name' => 'Pameran',
            'image' => 'https://images.unsplash.com/photo-1508997449629-303059a039c0?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&h=250'
        ],
        [
            'name' => 'Penayangan',
            'image' => 'https://images.unsplash.com/photo-1507924538820-ede94a04019d?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&h=250'
        ],
        [
            'name' => 'Permainan',
            'image' => 'https://images.pexels.com/photos/442576/pexels-photo-442576.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=250'
        ],
        [
            'name' => 'Pertapaan',
            'image' => 'https://images.pexels.com/photos/1051838/pexels-photo-1051838.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=250'
        ],
        [
            'name' => 'Pertunjukan',
            'image' => 'https://images.pexels.com/photos/1105666/pexels-photo-1105666.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=250'
        ],
        [
            'name' => 'Pesta',
            'image' => 'https://images.pexels.com/photos/1449795/pexels-photo-1449795.jpeg?auto=format%2Ccompress&cs=tinysrgb&dpr=2&h=250'
        ],
        [
            'name' => 'Seminar',
            'image' => 'https://images.unsplash.com/photo-1544531585-9847b68c8c86?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&h=250'
        ],
        [
            'name' => 'Turnamen',
            'image' => 'https://images.pexels.com/photos/54123/pexels-photo-54123.jpeg?auto=format%2Ccompress&cs=tinysrgb&dpr=2&h=250'
        ],
        [
            'name' => 'Wisata',
            'image' => 'https://images.pexels.com/photos/2108832/pexels-photo-2108832.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=250'
        ]
        ];

        foreach($ArrType as $data){
            DB::table('types')->insert([
                'name' => $data['name'],
                'image' => $data['image'],
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]);
        }
    }
}
