<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelativeDelayTimeColToQuestionsResults extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('questions_results', function (Blueprint $table) {
            $table->float('relative_delay_timeAnswering')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('questions_results', function (Blueprint $table) {
            $table->dropColumn('relative_delay_timeAnswering');
        });
    }
}
