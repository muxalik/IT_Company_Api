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
        Schema::create('employee_project', function (Blueprint $table) {
            $table->foreignId('employee_id')->constrained()->cascadeOnDelete();
            $table->foreignId('project_id')->constrained()->cascadeOnDelete();
            $table->boolean('is_favourite')->default(false);
            $table->integer('total_tasks')->unsigned()->default(0);
            $table->integer('tasks_done')->unsigned()->default(0);
            $table->integer('total_hours')->unsigned()->default(0);
            $table->integer('wasted_hours')->unsigned()->default(0);
            $table->timestamps();

            $table->primary(['employee_id', 'project_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_project');
    }
};
