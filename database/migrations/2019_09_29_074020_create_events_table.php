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
            $table->string('title', 100);
            $table->timestamp('publish_time');
            $table->timestamp('start_time');
            $table->timestamp('end_time');
            $table->string('location', 100);
            $table->string('location_guide', 150);
            $table->string('summary', 150)->nullable();
            $table->text('description');
            $table->string('image');
            $table->string('image_3d')->nullable();
            $table->string('status', 1)->default('1'); //1 for OK, 2 for hide, 3 for under investigation
            $table->timestamps();
            $table->softDeletes();
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
