<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained();
            $table->integer('salary')->unsigned();
            $table->string('avatar')->nullable();
            $table->string('country');
            $table->string('city');
            $table->string('languages');
            $table->string('phone')->nullable();
            $table->string('discord')->nullable();
            $table->integer('tasks_done')->unsigned()->default(0);
            $table->integer('projects_done')->unsigned()->default(0);
            $table->integer('wasted_years')->unsigned()->default(0);
            $table->ipAddress('ip_address');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
};
