<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_user', function (Blueprint $table) {
            $table->bigIncrements('userid');
            $table->string('roleid', 2);
            $table->string('username', 32);
            $table->string('password', 32);
            $table->string('email', 128);
            $table->string('fullname', 64);
            $table->string('created_by', 64);
            $table->timestamp('created_dt');
            $table->string('changed_by', 64)->nullable();
            $table->timestamp('changed_dt')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('m_user');
    }
}
