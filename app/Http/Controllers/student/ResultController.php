<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResultRequest;
use App\Models\Questions;
use App\Models\QuestionsResult;
use App\Models\Tests;
use App\Models\User;
use App\Models\UserPlans;
use App\Models\UserQuestionStartingTime;
use App\Models\UserStar;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResultController extends Controller
{

    /**
     * @var
     */
    protected $endTime;
    protected $i = 0;
    protected $pages = [];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return abort('403');
        $questions = Questions::all();
        return view('student.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ResultRequest $request)
    {
        return abort('404');
//        $answers = $request->answers;
//        $UserTakeExam = QuestionsResult::where('user_id', Auth::id())->get();
//        if (count($UserTakeExam) == 0) {
//            //process result and save to database
//            foreach ($answers as $key => $answer) {
//                $array = explode(',', $key);
//                $qID = $array[1];
//                $question = Questions::find($qID);
//                $result = new QuestionsResult();
//                $result->user_id = Auth::id();
//                $result->question_id = $qID;
//                $result->userAnswer = $answer;
//                if ($answer == $question->trueAnswer) {
//                    $result->answerStatus = 'true';
//                } else {
//                    $result->answerStatus = 'false';
//                }
//                $result->save();
//            }
//            \Illuminate\Support\Facades\Session::flash('result-save', "جواب های شما با موفقیت ذخیره شدند!");
//        } else {
//            \Illuminate\Support\Facades\Session::flash('result-forbidden', "شما در آزمون قبلا شرکت کرده اید");
//        }
//        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $now = Carbon::now();
        if ($now->lte(Tests::find($id)->startTime)) {
            $strTime = \Hekmatinasser\Verta\Facades\Verta::instance(Tests::find($id)->startTime)->formatDifference();
            $t = \Hekmatinasser\Verta\Facades\Verta::instance(Tests::find($id)->startTime);
            \Illuminate\Support\Facades\Session::flash('test-not-start', "این آزمون  در $strTime $t شروع میشود !");
            return redirect()->to("/homePage/$id");
        }
        if ($now->gt(Tests::find($id)->endTime)) {
            $testName = Tests::find($id)->name;
            \Illuminate\Support\Facades\Session::flash('no-question', "  $testName به پایان رسیده است");
            return redirect()->to('/');
        }
        //calculating the count of questions
        $questions = Questions::with(['lesson', 'test'])->where('test_id', $id)->whereHas('test', function (Builder $q) {
            $q->where('status', '1');
        })->get();
        $Qcount = count($questions);
        //calculating the count of questions


        $data = Questions::with('test')->where('test_id', $id)->whereHas('test', function (Builder $query) {
            $query->where('status', '1');
        })->paginate(1);
//        return $data->count();
        $currentPage = $data->currentPage();
        $totalPage = $data->total();
        if (count($data) != 0) {
            //starting answering question time process
            $start = UserQuestionStartingTime::where('user_id', Auth::id())
                ->where('question_id', $data[0]->id)
                ->where('test_id', $id)->get();

            if (count($start) == 0) {
                if ($currentPage > 10) {
                    if (Auth::user()->is_teacher == '1') {
                        //start question running time
                        $start = new \App\Models\UserQuestionStartingTime();
                        $start->user_id = \Illuminate\Support\Facades\Auth::id();
                        $start->test_id = $id;
                        $start->question_id = $data[0]->id;
                        $start->save();
                        //start question running time
                    } else {
                        if (Carbon::now()->diffInDays(Auth::user()->created_at) <= 7) {
                            //start question running time
                            $start = new \App\Models\UserQuestionStartingTime();
                            $start->user_id = \Illuminate\Support\Facades\Auth::id();
                            $start->test_id = $id;
                            $start->question_id = $data[0]->id;
                            $start->save();
                            //start question running time
                        } else {
                            if (count(UserPlans::where('user_id', Auth::id())->get()) == 0) {
                                \Illuminate\Support\Facades\Session::flash('access-error', "از مدت زمان ایجاد حساب شما 7 روز بیشتر گذشته است و شما دارای هیچ اشتراکی نمیباشید و لذا حق دسترسی به این قسمت را ندارید!");
//
                            } else {
                                foreach (UserPlans::where('user_id', Auth::id())->get() as $plan) {
                                    if (Carbon::now()->diffInDays($plan->created_at) <= $plan->plan->validityTime) {
                                        //start question running time
                                        $start = new \App\Models\UserQuestionStartingTime();
                                        $start->user_id = \Illuminate\Support\Facades\Auth::id();
                                        $start->test_id = $id;
                                        $start->question_id = $data[0]->id;
                                        $start->save();
                                        //start question running time
                                    }
                                }
                                \Illuminate\Support\Facades\Session::flash('access-error', "از مدت زمان ایجاد حساب شما 7 روز بیشتر گذشته است و همچنین اعتبار طرح های خریداری شده ی شما به پایان رسیده است ، لذا حق دسترسی به این قسمت را ندارید!");
                            }
                        }
                    }
                } else {
                    //start question running time
                    $start = new \App\Models\UserQuestionStartingTime();
                    $start->user_id = \Illuminate\Support\Facades\Auth::id();
                    $start->test_id = $id;
                    $start->question_id = $data[0]->id;
                    $start->save();
                    //start question running time
                }
            } else {
                if (User::find(Auth::id())->stars->TotalScore >= Questions::find($data[0]->id)->QuestionStar) {

                    if ($currentPage > 10) {

                        if (Auth::user()->is_teacher == '1') {
                            //update start question time running
                            $start = UserQuestionStartingTime::where('user_id', Auth::id())
                                ->where('test_id', $id)
                                ->where('question_id', $data[0]->id)->first();
                            $start->updated_at = Carbon::now();
                            $start->save();
                            //update start question time running
                        } else {
                            if (Carbon::now()->diffInDays(Auth::user()->created_at) <= 7) {
                                //update start question time running
                                $start = UserQuestionStartingTime::where('user_id', Auth::id())
                                    ->where('test_id', $id)
                                    ->where('question_id', $data[0]->id)->first();
                                $start->updated_at = Carbon::now();
                                $start->save();
                                //update start question time running
                            } else {
                                if (count(UserPlans::where('user_id', Auth::id())->get()) == 0) {
                                    \Illuminate\Support\Facades\Session::flash('access-error', "از مدت زمان ایجاد حساب شما 7 روز بیشتر گذشته است و شما دارای هیچ اشتراکی نمیباشید و لذا حق دسترسی به این قسمت را ندارید!");
//
                                } else {
                                    foreach (UserPlans::where('user_id', Auth::id())->get() as $plan) {
                                        if (Carbon::now()->diffInDays($plan->created_at) <= $plan->plan->validityTime) {
                                            //update start question time running
                                            $start = UserQuestionStartingTime::where('user_id', Auth::id())
                                                ->where('test_id', $id)
                                                ->where('question_id', $data[0]->id)->first();
                                            $start->updated_at = Carbon::now();
                                            $start->save();
                                            //update start question time running
                                        }
                                    }
                                    \Illuminate\Support\Facades\Session::flash('access-error', "از مدت زمان ایجاد حساب شما 7 روز بیشتر گذشته است و همچنین اعتبار طرح های خریداری شده ی شما به پایان رسیده است ، لذا حق دسترسی به این قسمت را ندارید!");
                                    return redirect()->to('/');
                                }
                            }
                        }
                    } else {
                        //update start question time running
                        $start = UserQuestionStartingTime::where('user_id', Auth::id())
                            ->where('test_id', $id)
                            ->where('question_id', $data[0]->id)->first();
                        $start->updated_at = Carbon::now();
                        $start->save();
                        //update start question time running
                    }

                }
            }

            if (count(QuestionsResult::where('user_id', Auth::id())->where('test_id', $id)->get()) != count(UserQuestionStartingTime::where('test_id', $id)->where('user_id', Auth::id())->get())) {
                \Illuminate\Support\Facades\Session::flash('question-not-end', "شما به برخی از سوالات هنوز جواب نداده اید!");
            }
            //end starting answering question time process


            return view('student.show', compact(['data', 'Qcount', 'currentPage', 'totalPage']));
        } else {
            \Illuminate\Support\Facades\Session::flash('no-question', "هنوز سوالی برای آزمون درنظر نگرفته شده است!");
            return redirect()->to('/');
        }
    }

    public function showUserResult($id)
    {
        $test = Tests::find($id);
        $result = QuestionsResult::where('user_id', Auth::id())->where('test_id', $id)->get();
        return view('student.showResult', compact(['test', 'result']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

//ResultRequest
    public function check(ResultRequest $request)
    {

        Tests::find($request->testId)->endTime;
        $now = Carbon::now();
        if ($now->gt(Tests::find($request->testId)->endTime)) {
            \Illuminate\Support\Facades\Session::flash('result-forbidden', "زمان پاسخ دهی به آزمون تمام شده است");
            return redirect()->back();
        }
        $endTime = Carbon::now();
        $answers = $request->answers;
        $i = 0;
        foreach ($answers as $key => $answer) {
            $i++;
            $array = explode(',', $key);
            $qID = $array[1];
            $question = Questions::find($qID);
            $UserTakingExam = QuestionsResult::where('user_id', Auth::id())->where('test_id', $request->testId)->where('question_id', $qID)->get();
            if (count($UserTakingExam) == 0) {
                $result = new QuestionsResult();
                $result->user_id = Auth::id();
                $result->question_id = $qID;
                $result->userAnswer = $answer;
                $result->test_id = $request->testId;
                if ($answer == $question->trueAnswer) {
                    $result->answerStatus = 'true';
                } else {
                    if (User::find(Auth::id())->stars->TotalScore >= Questions::find($qID)->QuestionStar) {
                        \Illuminate\Support\Facades\Session::flash('answer-false', "شما به سوال اشتباه پاسخ دادید،مجموع امتیازات شما بیشتر از امتیاز سوال است و در صورت تمایل میتوانید دوباره به سوال پاسخ دهید ");
                    }
                    $result->answerStatus = 'false';
                }
                $startTime = UserQuestionStartingTime::where('user_id', Auth::id())->where('test_id', $request->testId)->where('question_id', $qID)->first();
                if ($endTime->diffInMinutes($startTime->created_at) >= Questions::find($qID)->TimeToAnswer) {
                    $result->relative_delay_timeAnswering = ($endTime->diffInMinutes($startTime->created_at)) / (Questions::find($qID)->TimeToAnswer);
                    $qqqN = Questions::find($qID)->question;
                    \Illuminate\Support\Facades\Session::flash('result-delay', "زمان پاسخگویی به $qqqN تمام شد و پاسخ شما با نمره ی کمتری ذخبره خواهد شد!");
                    if ($answer == $question->trueAnswer) {
                        $result->star = (Questions::find($qID)->QuestionStar) * ((Questions::find($qID)->TimeToAnswer) / ($endTime->diffInMinutes($startTime->created_at)));
                    } else {
                        $result->star = 0;
                    }
                } else {
                    if ($answer == $question->trueAnswer) {
                        $result->star = Questions::find($qID)->QuestionStar;
                    } else {
                        $result->star = 0;
                    }
                }
                $result->save();
                //اینجا امتیاز سوال باید به امتیاز کاربر افزوده شود
                $userStar = UserStar::where('user_id', Auth::id())->first();
                if ($userStar) {
                    $userStar->TotalScore = ($userStar->TotalScore) + ($result->star);
                    $userStar->save();
                } else {
                    $userStar = new UserStar();
                    $userStar->user_id = Auth::id();
                    $userStar->TotalScore = $result->star;
                    $userStar->save();
                }

                \Illuminate\Support\Facades\Session::flash('result-save', "جواب شما با موفقیت ذخیره شد(اکنون به سوال بعدی بروید)!");
            } else {
                if (User::find(Auth::id())->stars->TotalScore >= Questions::find($qID)->QuestionStar
                    && $result = QuestionsResult::where('user_id', Auth::id())
                            ->where('test_id', $request->testId)
                            ->where('question_id', $qID)->first()->answerStatus == 'false') {
                    //کم کردن  امتیاز کاربر به اندازه ی امتیاز سوال
                    $model = UserStar::where('user_id', Auth::id())->first();
                    $model->TotalScore = ($model->TotalScore) - (Questions::find($qID)->QuestionStar);
                    $model->save();
                    //کم کردن  امتیاز کاربر به اندازه ی امتیاز سوال

                    $result = QuestionsResult::where('user_id', Auth::id())
                        ->where('test_id', $request->testId)
                        ->where('question_id', $qID)->first();
                    $result->userAnswer = $answer;
                    if ($answer == $question->trueAnswer) {
                        $result->answerStatus = 'true';
                    } else {
                        if (User::find(Auth::id())->stars->TotalScore >= Questions::find($qID)->QuestionStar) {
                            \Illuminate\Support\Facades\Session::flash('answer-false', "شما به سوال اشتباه پاسخ دادید،مجموع امتیازات شما بیشتر از امتیاز سوال است و در صورت تمایل میتوانید دوباره به سوال پاسخ دهید ");
                        }
                        $result->answerStatus = 'false';
                    }

                    $startTime = UserQuestionStartingTime::where('user_id', Auth::id())
                        ->where('test_id', $request->testId)
                        ->where('question_id', $qID)->first();
                    if ($endTime->diffInMinutes($startTime->updated_at) >= Questions::find($qID)->TimeToAnswer) {
                        $result->relative_delay_timeAnswering = ($endTime->diffInMinutes($startTime->created_at)) / (Questions::find($qID)->TimeToAnswer);
                        $qqqN = Questions::find($qID)->question;
                        \Illuminate\Support\Facades\Session::flash('result-delay', "زمان پاسخگویی به $qqqN تمام شد و پاسخ شما با نمره ی کمتری ذخبره خواهد شد!");
                        if ($answer == $question->trueAnswer) {
                            $result->star = (Questions::find($qID)->QuestionStar) * ((Questions::find($qID)->TimeToAnswer) / ($endTime->diffInMinutes($startTime->updated_at)));
                        } else {
                            $result->star = 0;
                        }
                    } else {
                        if ($answer == $question->trueAnswer) {
                            $result->star = Questions::find($qID)->QuestionStar;
                        } else {
                            $result->star = 0;
                        }
                    }
                    $result->save();

                    //اینجا امتیاز سوال باید به امتیاز کاربر افزوده شود
                    $userStar = UserStar::where('user_id', Auth::id())->first();
                    if ($userStar) {
                        $userStar->TotalScore = ($userStar->TotalScore) + ($result->star);
                        $userStar->save();
                    } else {
                        $userStar = new UserStar();
                        $userStar->user_id = Auth::id();
                        $userStar->TotalScore = $result->star;
                        $userStar->save();
                    }

                    \Illuminate\Support\Facades\Session::flash('result-save', "جواب شما با موفقیت ذخیره شد(اکنون به سوال بعدی بروید)!");

//                    $result->answerStatus = $answer;
                } else {
                    if (User::find(Auth::id())->stars->TotalScore >= Questions::find($qID)->QuestionStar && $result = QuestionsResult::where('user_id', Auth::id())
                                ->where('test_id', $request->testId)
                                ->where('question_id', $qID)->first()->answerStatus == 'true')
                    \Illuminate\Support\Facades\Session::flash('result-forbidden', "شما قبلا به این سوال در این آزمون پاسخ داده اید");
                }
            }
        }
        if ($i == count(Questions::where('test_id', $request->testId)->get())) {
            \Illuminate\Support\Facades\Session::flash('test-end', "آزمون به پایان رسید");
        }
        return redirect()->back();
    }

    public function spin($number)
    {
        $modelExistence = UserStar::where('user_id', Auth::id())->first();
        if ($modelExistence) {
            $now = Carbon::now();
            if ($now->diffInHours($modelExistence->updated_at) < 24) {
                return 'timeError';
            }
            $modelExistence->TotalScore = $modelExistence->TotalScore + $number;
            $modelExistence->save();
        } else {
            $model = new UserStar();
            $model->user_id = Auth::id();
            $model->TotalScore = $number;
            $model->save();
        }
        return 'ok!' . $number;
    }

}
