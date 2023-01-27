<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLearningsfedbackToBehavioresat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('behavioresat', function (Blueprint $table) {
            $table->text('learnings')->nullable();
            $table->text('intervention')->nullable();
            $table->text('timeline')->nullable();
            $table->text('resources')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('behavioresat', function (Blueprint $table) {
            $table->dropColumn('learnings');
            $table->dropColumn('intervention');
            $table->dropColumn('timeline');
            $table->dropColumn('resources');
        });
    }
}
