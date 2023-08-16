<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('school_year_id');
            $table->unsignedInteger('classroom_id');
            $table->char('identity', 8)->unique();
            $table->string('name', 255);
            $table->string('phone', 255)->nullable();
            $table->date('birth_date')->nullable();
            $table->string('birth_place', 255)->nullable();
            $table->string('religion', 255)->nullable();
            $table->string('gender', 255)->nullable();
            $table->string('address', 255)->nullable();
            $table->string('photo', 255)->nullable();
            $table->string('blood_type', 255)->nullable();
            $table->string('parent_name', 255)->nullable();
            $table->string('parent_phone', 255)->nullable();
            $table->string('parent_address', 255)->nullable();
            $table->unsignedInteger('user_id')->nullable();
            $table->string('password_hint', 255)->nullable();
            $table->timestamps();

            $table->foreign('school_year_id')->references('id')->on('school_years')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('classroom_id')->references('id')->on('classrooms')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
