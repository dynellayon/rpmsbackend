<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEsatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('esat', function (Blueprint $table) {
            $table->id();
            $table->integer('employeeid');
            $table->integer('objectiveid');
            $table->integer('level');
            $table->integer('priotrity');
            $table->integer('taskid');
            $table->string('comments')->nullable();

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
        Schema::dropIfExists('esat');
    }
}
