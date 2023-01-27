<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRatingToDevelopementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('developement', function (Blueprint $table) {
               $table->integer('phaseid')->nullable();
               $table->integer('taskid')->nullable();
              $table->integer('rating')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('developement', function (Blueprint $table) {
            $table->dropColumn('phasid');
            $table->dropColumn('taskid');
            $table->dropColumn('rating');
        });
    }
}
