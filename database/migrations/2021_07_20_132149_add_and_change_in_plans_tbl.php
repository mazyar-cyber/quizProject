<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAndChangeInPlansTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropColumns('plans', 'star');
        Schema::table('plans', function (Blueprint $table) {
            $table->bigInteger('validityTime');
            $table->string('description', '350');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('plans', function (Blueprint $table) {
            $table->bigInteger('star');
            $table->dropColumn(['validityTime', 'description']);
        });
    }
}
