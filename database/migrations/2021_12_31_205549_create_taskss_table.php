<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskssTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taskss', function (Blueprint $table) {
            $table->increments('id');
            $table->text('task');
            $table->unsignedInteger('target_id');
            $table->unsignedInteger('order');
            $table->date('start');
            $table->date('end_schedule');
            $table->date('end')->nullable();
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
        Schema::dropIfExists('taskss');
    }
}
