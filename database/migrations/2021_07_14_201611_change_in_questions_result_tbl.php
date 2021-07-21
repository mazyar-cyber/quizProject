<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ChangeInQuestionsResultTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE questions_results MODIFY answerStatus ENUM('true', 'false', 'noAnswer') NOT NULL");

//        Schema::table('questions_results', function (Blueprint $table) {
//            $table->enum('answerStatus', ['true', 'false', 'noAnswer'])->change();
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("ALTER TABLE questions_results MODIFY answerStatus ENUM('true', 'false') NOT NULL");

//        Schema::table('questions_results', function (Blueprint $table) {
//            //
//        });
    }
}
