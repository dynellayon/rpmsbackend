<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->integer('objectiveid');
            $table->integer('taskid');
            $table->integer('phaseid');
            $table->integer('quality');
            $table->integer('efficiency');
            $table->integer('timeliness');
            $table->text('remarks')->nullable();
            $table->float('average', 8, 2)->nullable();
            $table->float('score', 8, 2)->nullable();
            $table->float('midyear', 8, 2)->nullable();
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
        Schema::dropIfExists('ratings');
    }
}
