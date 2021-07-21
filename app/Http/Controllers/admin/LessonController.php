<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LessonCreateRequest;
use App\Models\Lessons;
use App\Models\Questions;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lessons = Lessons::all();
        return view('admin.lesson.index', compact('lessons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.lesson.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(LessonCreateRequest $request)
    {
        $lesson = new Lessons();
        $lesson->name = $request->name;
        $lesson->save();
        \Illuminate\Support\Facades\Session::flash('lesson-save', "درس با موفقیت ایجاد شد!");
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lesson = Lessons::find($id);
        return view('admin.lesson.edit', compact('lesson'));
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
        $lesson = Lessons::findOrfail($id);
        $lesson->name = $request->name;
        $lesson->save();
        \Illuminate\Support\Facades\Session::flash('lesson-edit', "درس با موفقیت ویرایش شد!");
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
        //
    }

    public function deleteSelected(Request $request)
    {
        foreach ($request->checkBoxArray as $id) {
            $lesson = Lessons::find($id);
            $lesson->delete();
        }
        \Illuminate\Support\Facades\Session::flash('lesson-delete', " درس های انتخاب شده شما با موفقیت حذف شدند!");
        return redirect()->back();
    }
}
