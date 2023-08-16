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
            $table->string('identity', 255)->unique();
            $table->string('name', 255);
            $table->string('phone', 255);
            $table->string('address', 255);
            $table->string('gender', 255);
            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('user_id');
            $table->string('password_hint', 255)->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
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