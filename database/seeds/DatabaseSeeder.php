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

        $arrCategories = [
            [
                'name' => 'Amal',
                'image' => 'https://images.unsplash.com/photo-1532629345422-7515f3d16bb6?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&h=250'
            ],
            [
                'name' => 'Bisnis',
                'image' => 'https://images.pexels.com/photos/1509428/pexels-photo-1509428.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=250'
            ],
            [
                'name' => 'Fashion',
                'image' => 'https://images.pexels.com/photos/413727/pexels-photo-413727.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=250'
            ],
            [
                'name' => 'Film & Media',
                'image' => 'https://images.unsplash.com/photo-1440404653325-ab127d49abc1?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&h=250'
            ],
            [
                'name' => 'Geek',
                'image' => 'https://images.unsplash.com/photo-1520110120835-c96534a4c984?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&h=250'
            ],
            [
                'name' => 'Hobi',
                'image' => 'https://images.pexels.com/photos/260024/pexels-photo-260024.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=250'
            ],
            [
                'name' => 'Keluarga',
                'image' => 'https://images.pexels.com/photos/377058/pexels-photo-377058.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=250'
            ],
            [
                'name' => 'Kegiatan Sekolah',
                'image'=> 'https://images.pexels.com/photos/267885/pexels-photo-267885.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=250'
            ],
            [
                'name' => 'Kesehatan',
                'image' => 'https://images.pexels.com/photos/1919236/pexels-photo-1919236.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=250'
            ],
            [
                'name' => 'Kerohanian',
                'image' => 'https://images.unsplash.com/photo-1530368333607-c100785945b5?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&h=250'
            ],
            [
                'name' => 'Komunitas',
                'image' => 'https://images.pexels.com/photos/461049/pexels-photo-461049.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=250'
            ],
            [
                'name' => 'Liburan',
                'image' => 'https://images.pexels.com/photos/255377/pexels-photo-255377.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=250'
            ],
            [
                'name' => 'Lingkungan',
                'image' => 'https://images.pexels.com/photos/235615/pexels-photo-235615.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=250'
            ],
            [
                'name' => 'Makanan & Minuman',
                'image' => 'https://images.pexels.com/photos/1268558/pexels-photo-1268558.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=250'
            ],
            [
                'name' => 'Musik',
                'image' => 'https://images.pexels.com/photos/1763075/pexels-photo-1763075.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=250'
            ],
            [
                'name' => 'Olahraga & Kebugaran',
                'image' => 'https://images.pexels.com/photos/1415810/pexels-photo-1415810.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=250'
            ],
            [
                'name' => 'Otomotif',
                'image' => 'https://images.pexels.com/photos/355913/pexels-photo-355913.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=250'
            ],
            [
                'name' => 'Pemerintahan',
                'image' => 'https://images.pexels.com/photos/2310754/pexels-photo-2310754.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=250'
            ],
            [
                'name' => 'Pendidikan',
                'image'=> '"ttps://images.pexels.com/photos/355988/pexels-photo-355988.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=250'
            ],
            [
                'name' => 'Penerbangan',
                'image' => 'https://images.pexels.com/photos/459402/pexels-photo-459402.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=250'
            ],
            [
                'name' => 'Perahu',
                'image' => 'https://images.pexels.com/photos/76978/pexels-photo-76978.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=250'
            ],
            [
                'name' => 'Pertunjukan Seni',
                'image' => 'https://images.unsplash.com/photo-1495791185843-c73f2269f669?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=250'
            ],
            [
                'name' => 'Rumah & Gaya Hidup',
                'image' => 'https://images.unsplash.com/photo-1556912998-c57cc6b63cd7?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&h=250'
            ],
            [
                'name' => 'Sains',
                'image' => 'https://images.pexels.com/photos/256262/pexels-photo-256262.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=250'
            ],
            [
                'name' => 'Startup',
                'image' => 'https://images.unsplash.com/photo-1556742111-a301076d9d18?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&h=250'
            ],
            [
                'name' => 'Teknologi',
                'image' => 'https://images.unsplash.com/photo-1518770660439-4636190af475?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&h=250'
            ],
            [
                'name' => 'Travel & Outdoor',
                'image' => 'https://images.pexels.com/photos/2174656/pexels-photo-2174656.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=250'
            ],
            [
                'name' => 'Lainnya',
                'image' => 'https://images.unsplash.com/photo-1508778552286-12d4c6007799?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&h=250'
            ]
        ];
        foreach($arrCategories as $data){
            DB::table('categories')->insert([
                'name' => $data['name'],
                'image' => $data['image'],
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]);
        }
    }
}
