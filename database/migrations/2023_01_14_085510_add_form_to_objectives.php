<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFormToObjectives extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('objectives', function (Blueprint $table) {
            $table->integer('quality')->nullable();
            $table->integer('efficiency')->nullable();
            $table->integer('timeliness')->nullable();
            $table->integer('average')->nullable();
            $table->integer('score')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('objectives', function (Blueprint $table) {
            $table->dropColumn('quality');
            $table->dropColumn('efficiency');
            $table->dropColumn('timeliness');
            $table->dropColumn('average');
            $table->dropColumn('score');
        });
    }
}
