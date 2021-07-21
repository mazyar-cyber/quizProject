<?php

namespace App\Http\Controllers\admin;

use Intervention\Image\Facades\Image;
use App\Http\Controllers\Controller;
use App\Http\Requests\QuestionCreateRequest;
use App\Http\Requests\QuestionUpdateRequest;
use App\Models\Lessons;
use App\Models\Questions;
use App\Models\Tests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Questions::all();
        return view('admin.question.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tests = Tests::all();
        $lessons = Lessons::all();
        return view('admin.question.create', compact(['tests', 'lessons']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuestionCreateRequest $request)
    {
//        if ($request->file('pic')) {
//            $image = $request->file('pic');
//            $name = time() . $image->getClientOriginalName();
//            $request->file('pic')->storeAs("public/photos/question", "$name");
//            return 'ok';
////            $name = time() . '.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
//            Image::make($request->file('pic'))->save(public_path('images/') . $name);
////            \Image::make($request->file('pic'))->save(public_path('images/') . $name);
//        }
//
//        return 'ok!';


        $test = Tests::find($request->test);
        $time = 0;
        foreach ($test->questions as $q) {
            $time = $time + $q->TimeToAnswer;
        }
        if ($time + $request->TimeToAnswer > $test->expiration) {
            \Illuminate\Support\Facades\Session::flash('question-time-error', "مدت زمان پاسخ دهی به سوال بیشتر از محدوده ی زمانی '$test->name' است!");
            return redirect()->back();
        }
        $question = new Questions();
        $question->question = $request->question;
        $question->answer1 = $request->answer1;
        $question->answer2 = $request->answer2;
        $question->answer3 = $request->answer3;
        $question->answer4 = $request->answer4;
        $question->test_id = $request->test;
        $question->lesson_id = $request->lesson;
        $question->TimeToAnswer = $request->TimeToAnswer;
        $question->QuestionStar = $request->questionStar;
        //uploading part
        if ($request->file('pic')) {
            $file = $request->file('pic');
            $filename = time() . $file->getClientOriginalName();
            Storage::disk('public')->putFileAs('/photos/question', $file, $filename);
            $question->photo_path = $filename;
        }
        //end uploading part

        $question->trueAnswer = $request->trueAnswer;
        $question->save();
        \Illuminate\Support\Facades\Session::flash('question-save', "نمونه سوال شما با موفقیت ذخیره شد!");
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return 'here is show method';
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tests = Tests::all();
        $question = Questions::find($id);
        $lessons = Lessons::all();
        return view('admin.question.edit', compact(['question', 'tests', 'lessons']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(QuestionUpdateRequest $request, $id)
    {
        $question = Questions::find($id);
        $test = Tests::find($request->test);
        $time = 0;
        foreach ($test->questions as $q) {
            $time = $time + $q->TimeToAnswer;
        }
        $time = $time - $question->TimeToAnswer;
        if ($time + $request->TimeToAnswer > $test->expiration) {
            \Illuminate\Support\Facades\Session::flash('question-time-error', "مدت زمان پاسخ دهی به سوال بیشتر از محدوده ی زمانی '$test->name' است!");
            return redirect()->back();
        }
        $question->question = $request->question;
        $question->answer1 = $request->answer1;
        $question->answer2 = $request->answer2;
        $question->answer3 = $request->answer3;
        $question->answer4 = $request->answer4;
        $question->test_id = $request->test;
        $question->lesson_id = $request->lesson;
        $question->TimeToAnswer = $request->TimeToAnswer;
        $question->QuestionStar = $request->questionStar;
        //uploading part
        if ($request->file('pic')) {
            $file = $request->file('pic');
            $filename = time() . $file->getClientOriginalName();
            @unlink("storage/photos/question/$question->photo_path");
            Storage::disk('public')->putFileAs('/photos/question', $file, $filename);
            $question->photo_path = $filename;
        }
        //end uploading part

        $question->trueAnswer = $request->trueAnswer;
        $question->save();
        \Illuminate\Support\Facades\Session::flash('question-edit', "نمونه سوال شما با موفقیت ویرایش شد!");
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $id;
    }

    public function deleteSelected(Request $request)
    {
        foreach ($request->checkBoxArray as $id) {
            $q = Questions::find($id);
            @unlink("uploads/photos/question/$q->photo_path");
            $q->delete();
        }
        \Illuminate\Support\Facades\Session::flash('question-delete', " سوالات انتخاب شده شما با موفقیت حذف شدند!");
        return redirect()->back();
    }
}
