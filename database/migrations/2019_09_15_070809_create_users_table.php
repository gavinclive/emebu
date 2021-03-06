<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

// Table untuk user 

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 100);
            $table->string('email')->unique();
            $table->string('image')->default('https://user-images.githubusercontent.com/16608864/35882949-bbe13aa0-0bab-11e8-859c-ceda3b213818.jpeg');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('role', 1); //1 = member, 2 = admin, 3 = eo, 4 = super EO
            $table->string('bank')->nullable();
            $table->string('acc_number')->nullable();
            $table->enum('status', ['active', 'inactive']);
            $table->string('last_login')->default(null);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
