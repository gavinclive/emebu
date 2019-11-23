<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class TransactionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('transactions')->insert([
            'id' => 'd3d29d70-1d25-11e3-8591-034165a3a613',
            'qty' => 33,
            'created_at' => Carbon::now(),
            'settled_at' => Carbon::now(),
            'member_id' => 3,
            'ticket_id' => 1,
            'coupon_id' => 1,
        ]);
    }
}
