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
        Schema::create('company_advisors', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('company_id');
            $table->string('identity', 255)->unique();
            $table->string('name', 255);
            $table->string('phone', 255);
            $table->string('gender');
            $table->text('address');
            $table->unsignedInteger('user_id')->nullable();
            $table->string('password_hint', 255)->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->foreign('company_id')->references('id')->on('companies')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_advisors');
    }
};
