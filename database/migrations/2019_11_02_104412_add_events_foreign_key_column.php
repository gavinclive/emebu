<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEventsForeignKeyColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->bigInteger('type_id');
            $table->foreign('type_id')->references('id')->on('types');
            $table->bigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories');
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
        Schema::table('events', function (Blueprint $table) {
            $table->dropForeign(['type_id', 'category_id', 'eo_id']);
            $table->dropColumn(['type_id', 'category_id', 'eo_id']);
        });
    }
}
