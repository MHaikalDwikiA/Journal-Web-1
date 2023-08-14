<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyAdvisorsTable extends Migration
{
    public function up()
    {
        Schema::create('company_advisors', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('company_id');
            $table->string('identity');
            $table->string('name');
            $table->string('phone');
            $table->text('address');
            $table->string('gender');
            $table->string('is_active')->default(false);
            $table->unsignedInteger('user_id')->nullable();
            $table->string('password_hint')->nullable();
            $table->timestamps();

            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('company_advisors');
    }
}
