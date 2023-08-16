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
        Schema::create('internship_companies', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('internship_id');
            $table->string('since', 255);
            $table->text('sectors');
            $table->text('services');
            $table->text('address');
            $table->string('telephone', 255);
            $table->string('email', 255);
            $table->string('website', 255);
            $table->string('director', 255);
            $table->string('varchar', 255);
            $table->text('advisors');
            $table->string('structure', 255);
            $table->timestamps();

            $table->foreign('internship_id')->references('id')->on('internships')->onUpdate('cascade')->onDelete('cascade');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('internship_companies');
    }
};
