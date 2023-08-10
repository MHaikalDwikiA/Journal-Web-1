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
        Schema::create('internships', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('school_year_id');
            $table->unsignedInteger('student_id');
            $table->unsignedInteger('company_id')->nullable();
            $table->unsignedInteger('school_advisor_id')->nullable();
            $table->unsignedInteger('company_advisor_id')->nullable();
            $table->string('working_day')->nullable();
            $table->timestamps();

            $table->foreign('school_year_id')->references('id')->on('school_years')->onDelete('cascade');
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('school_advisor_id')->references('id')->on('school_advisors')->onDelete('cascade');
            $table->foreign('company_advisor_id')->references('id')->on('company_advisors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('internships');
    }
};
