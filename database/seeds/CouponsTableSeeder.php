<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CouponsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('coupons')->insert([
            'code' => 'TWITCHTV',
            'qty' => '1000',
            'daily_reset' => 0,
            'start_time' => Carbon::now(),
            'end_time' => Carbon::now()->addMonths(2),
            'rate' => 50,
            'max_cut' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'event_id' => 1
        ]);
    }
}
