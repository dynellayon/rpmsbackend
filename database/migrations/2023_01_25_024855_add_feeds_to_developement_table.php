<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFeedsToDevelopementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('developement', function (Blueprint $table) {
            $table->text('learn');
            $table->text('interven');
            $table->text('timeli');
            $table->text('resour');
            $table->text('feedba');
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
            $table->dropColumn('learn');
            $table->dropColumn('interven');
            $table->dropColumn('timeli');
            $table->dropColumn('resour');
            $table->dropColumn('feedba');
        });
    }
}
