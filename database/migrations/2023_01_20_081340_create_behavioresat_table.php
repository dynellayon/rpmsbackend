<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBehavioresatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('behavioresat', function (Blueprint $table) {
            $table->id();
            $table->integer("employeeid");
            $table->integer("behaiorid");
            $table->integer("total");
            $table->integer("phaseid");
            $table->integer("taskid");
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
        Schema::dropIfExists('behavioresat');
    }
}
