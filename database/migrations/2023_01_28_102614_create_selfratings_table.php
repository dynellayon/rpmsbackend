<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSelfratingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('selfratings', function (Blueprint $table) {
            $table->id();
            $table->integer('phaseid');
            $table->integer('empolyeeid');
            $table->integer('objectiveid');
            $table->integer('taskid');
            $table->integer('quality');
            $table->integer('efficiency');
            $table->integer('timeliness');
            $table->float('average', 8, 2)->nullable();
            $table->float('score', 8, 2)->nullable();
            $table->string('remarks')->nullable();
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
        Schema::dropIfExists('selfratings');
    }
}
