<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function PHPUnit\Framework\once;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('internship_rules', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('school_year_id');
            $table->tinyInteger('sequence');
            $table->text('description');
            $table->timestamps();

            $table->foreign('school_year_id')->references('id')->on('school_years')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('internship_rules');
    }
};
