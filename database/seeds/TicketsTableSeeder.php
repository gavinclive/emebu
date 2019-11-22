<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class TicketsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tickets')->insert([
            'name' => 'General Admission',
            'price' => '420420',
            'sold' => 1,
            'qty' => 888,
            'description' => 'No please dont leave for Mixer',
            'start_time' => Carbon::now(),
            'end_time' => Carbon::now()->addDays(10),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'event_id' => 1
        ]);
    }
}
