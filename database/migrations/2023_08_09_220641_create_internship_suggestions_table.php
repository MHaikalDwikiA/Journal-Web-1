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
        Schema::create('internship_suggestions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('internship_id');
            $table->unsignedInteger('company_employee_id');
            $table->text('suggest');
            $table->unsignedInteger('approval_user_id')->nullable();
            $table->string('approval_by', 255);
            $table->timestamp('approval_at')->nullable();
            $table->timestamps();

            $table->foreign('internship_id')->references('id')->on('internships')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('company_employee_id')->references('id')->on('internship_company_employees')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('approval_user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('internship_suggestions');
    }
};