<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('school_year_id')->nullable();
            $table->unsignedInteger('classroom_id')->nullable();
            $table->string('identity')->unique();
            $table->string('name');
            $table->string('phone')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('birth_place')->nullable();
            $table->string('religion')->nullable();
            $table->string('gender')->nullable();
            $table->string('address')->nullable();
            $table->string('photo')->nullable();
            $table->string('blood_type')->nullable();
            $table->string('parent_name')->nullable();
            $table->string('parent_phone')->nullable();
            $table->string('parent_address')->nullable();
            $table->timestamps();
            $table->unsignedInteger('user_id');
            $table->string('password_hint')->nullable();

            $table->foreign('school_year_id')->references('id')->on('school_years')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('classroom_id')->references('id')->on('classrooms')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('students');
    }
}
