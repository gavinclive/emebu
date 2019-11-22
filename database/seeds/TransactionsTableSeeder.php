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
            'qty' => 33,
            'created_at' => Carbon::now(),
            'settled_at' => Carbon::now(),
            'member_id' => 3,
            'ticket_id' => 1,
        ]);
    }
}
