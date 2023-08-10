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
        Schema::create('school_advisors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('identity');
            $table->string('name');
            $table->string('phone');
            $table->text('address');
            $table->string('gender');
            $table->boolean('is_active');
            $table->unsignedInteger('user_id');
            $table->string('password_hint');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('school_advisors');
    }
};
