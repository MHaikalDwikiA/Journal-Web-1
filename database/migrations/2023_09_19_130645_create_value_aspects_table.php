<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateValueAspectsTable extends Migration
{
    public function up()
    {
        Schema::create('value_aspects', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('internship_id');
            $table->unsignedInteger('assessment_aspect_id');
            $table->string('value_with_numbers')->nullable();
            $table->string('value_with_letters')->nullable();
            $table->string('verification')->nullable();
            $table->timestamps();

            $table->foreign('internship_id')->references('id')->on('internships');
            $table->foreign('assessment_aspect_id')->references('id')->on('assessment_aspects');
        });
    }

    public function down()
    {
        Schema::dropIfExists('value_aspects');
    }
}
