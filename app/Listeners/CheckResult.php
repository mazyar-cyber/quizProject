<?php

namespace App\Listeners;

use App\Events\ResultSeen;
use App\Models\Tests;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CheckResult
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param ResultSeen $event
     * @return void
     */
    public function handle(ResultSeen $event)
    {
        $model = \App\Models\UserQuestionStartingTime::all();
        foreach ($model as $m) {
            $test = Tests::find($m->test_id);
            if (Carbon::now()->gt($test->endTime)) {
                foreach ($test->questions as $q) {
                    $resultExistance = \App\Models\QuestionsResult::where('user_id', $m->user_id)
                        ->where('test_id', $m->test_id)
                        ->where('question_id', $q->id)->first();
                    if ($resultExistance == null) {
                        $newResult = new \App\Models\QuestionsResult();
                        $newResult->user_id = $m->user_id;
                        $newResult->test_id = $m->test_id;
                        $newResult->question_id = $q->id;
                        $newResult->userAnswer = '0';
                        $newResult->answerStatus = 'noAnswer';
                        $newResult->relative_delay_timeAnswering = null;
                        $newResult->star = '0';
                        $newResult->save();
                    }
                }
            } else {
                \Illuminate\Support\Facades\Session::flash("$test->name-doesnt_end", "آزمون به پایان نرسیده است");
                $testNames[] = $test->name;

//                echo "آزمون  $test->name به پایان نرسیده است" . '</br>';
            }
        }
    }
}
