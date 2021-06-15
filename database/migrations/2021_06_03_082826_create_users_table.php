<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->unsignedBigInteger('type_user_id');
            $table->unsignedBigInteger('responsible_school_id')->nullable();
            $table->string('avatar')->nullable()->default('default.png');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();

            $table->foreign('type_user_id')->references('id')->on('type_users');
            $table->foreign('responsible_school_id')->references('id')->on('responsible_school');
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
