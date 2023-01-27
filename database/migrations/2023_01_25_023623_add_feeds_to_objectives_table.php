<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFeedsToObjectivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('objectives', function (Blueprint $table) {
            $table->text('learnings')->nullable();
            $table->text('intevention')->nullable();
            $table->text('timeline')->nullable();
            $table->text('resources')->nullable();
            $table->text('feedbacks')->nullable();
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
            $table->dropColumn('learnings');
            $table->dropColumn('intevention');
            $table->dropColumn('timeline');
            $table->dropColumn('resources');
            $table->dropColumn('feedbacks');
        });
    }
}
