<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResponsibleSchoolTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('responsible_school', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('school_id');
            $table->unsignedBigInteger('person_id');
            $table->unsignedBigInteger('responsability_school_id');

            $table->foreign('responsability_school_id')->references('id')->on('responsabilities_schools');
            $table->foreign('school_id')->references('id')->on('schools');
            $table->foreign('person_id')->references('id')->on('people');
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
        Schema::dropIfExists('responsible_school');
    }
}
