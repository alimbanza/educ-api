<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schools', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('adress')->nullable();
            $table->string('logo')->nullable();
            $table->string('matricule')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->unsignedBigInteger('category_school_id');
            $table->unsignedBigInteger('convention_id');

            $table->foreign('category_school_id')->references('id')->on('category_schools');
            $table->foreign('convention_id')->references('id')->on('conventions');
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
        Schema::dropIfExists('schools');
    }
}
