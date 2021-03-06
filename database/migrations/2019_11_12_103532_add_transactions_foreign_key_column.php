<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTransactionsForeignKeyColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->bigInteger('member_id');
            $table->foreign('member_id')->references('id')->on('users');
            $table->bigInteger('ticket_id');
            $table->foreign('ticket_id')->references('id')->on('tickets');
            $table->bigInteger('coupon_id')->nullable();
            $table->foreign('coupon_id')->references('id')->on('coupons');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropForeign(['member_id', 'ticket_id', 'coupon_d']);
            $table->dropColumn(['member_id', 'ticket_id', 'coupon_id
            ']);
        });
    }
}
