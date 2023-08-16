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
        Schema::create('internship_journals', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('internship_id');
            $table->date('date');
            $table->string('activity', 255);
            $table->string('activity_image', 255);
            $table->unsignedInteger('competency_id');
            $table->unsignedInteger('approval_user_id')->nullable();
            $table->string('approval_by', 255)->nullable();
            $table->timestamp('approval_at');
            $table->timestamps();

            $table->foreign('internship_id')->references('id')->on('internships')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('competency_id')->references('id')->on('internship_competencies')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('approval_user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('internship_journals');
    }
};