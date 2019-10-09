<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

//Table untuk create events

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title',100);
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->string('location',100);
            $table->string('summary',150);
            $table->text('description');
            $table->string('image',512);
            $table->string('type',50);
            $table->string('category',50);
            $table->string('image_3d', 1024)->nullable();
            $table->bigInteger('eo_id');
            $table->string('status', 1)->default('1'); //1 for OK, 2 for cancelled, 3 for under investigation
            $table->timestamps();

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
        Schema::dropIfExists('events');
    }
}
