<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddReportsForeignKeyColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->bigInteger('member_id');
            $table->foreign('member_id')->references('id')->on('users');
            $table->bigInteger('event_id');
            $table->foreign('event_id')->references('id')->on('events');
            $table->bigInteger('eo_id');
            $table->foreign('eo_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->dropForeign(['member_id', 'event_id', 'eo_id']);
            $table->dropColumn(['member_id', 'event_id', 'eo_id']);
        });
    }
}
