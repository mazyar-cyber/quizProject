<?php

namespace App\Http\Controllers\admin;

use App\Events\ResultSeen;
use App\Http\Controllers\Controller;
use App\Http\Requests\TestCreateRequest;
use App\Http\Requests\TestUpdateRequest;
use App\Models\Questions;
use App\Models\QuestionsResult;
use App\Models\Tests;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;


class TestContrller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tests = Tests::all();
        return view('admin.test.index', compact('tests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.test.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(TestCreateRequest $request)
    {

        $StartTime = Carbon::createFromTimeString($request->TestStartTime);
        $EndTime = Carbon::createFromTimeString($request->TestEndTime);
        $differnt = $EndTime->diffInMinutes($StartTime);
        $test = new Tests();
        $test->name = $request->name;
        $test->status = $request->status;
        $test->expiration = $differnt;
        $test->startTime = $StartTime;
        $test->endTime = $EndTime;
        $test->save();
        \Illuminate\Support\Facades\Session::flash('test-save', "<p style=\"color: blue\">آزمون شما ایجاد شد </p>");
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
        $tst = Tests::with('questions')->where('id', $id)->first();
        return view('admin.test.show', compact('tst'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $test = Tests::find($id);
        return view('admin.test.edit', compact('test'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(TestUpdateRequest $request, $id)
    {
        $StartTime = Carbon::createFromTimeString($request->TestStartTime);
        $EndTime = Carbon::createFromTimeString($request->TestEndTime);
        $differnt = $EndTime->diffInMinutes($StartTime);
        $test = Tests::find($id);
        $test->startTime = $StartTime;
        $test->endTime = $EndTime;
        $test->expiration = $differnt;
        $test->name = $request->name;
        $test->status = $request->status;
        $test->save();
//        \Illuminate\Support\Facades\Session::flash('test-update', " آزمون مورد نظر با موفقیت به روز شد!");
        \Illuminate\Support\Facades\Session::flash('test-update', "<p>آزمون <span style=\"font-weight: bolder\">$test->name</span> با موفقیت به روز شد</p>");
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
            $t = Tests::find($id);
            $t->delete();
        }
        \Illuminate\Support\Facades\Session::flash('test-delete', " آزمون ها انتخاب شده شما با موفقیت حذف شدند!");
        return redirect()->back();
    }

    public function showResult()
    {
        ResultSeen::dispatch();
        $results = QuestionsResult::all();
        return view('admin.test.result', compact('results'));
    }

    public function showResultApi($findBy = 'null')
    {
        $results = QuestionsResult::with(['question', 'user', 'test'])->get();
        $users = User::all();
        $tests = Tests::where('status', '1')->get();
        return $data[] = [$results, $users, $tests];
    }

    public function searchResultApi($type, $searchWord)
    {
        $results = QuestionsResult::with(['question', 'user', 'test'])->whereHas("$type", function (Builder $q) use ($searchWord) {
            $q->where('id', $searchWord);
        })->get();
        $users = User::all();
        $tests = Tests::where('status', '1')->get();
        return $data[] = [$results, $users, $tests];
    }

    public function searchResultApi2($types)
    {
        $users = User::all();
        $tests = Tests::where('status', '1')->get();

        $array = explode(',', $types);
        if ($array[0] == '') {
            //it means we have no test filtering
            if ($array[1] == '') {
                //it means we have no user filtering
                $results = QuestionsResult::with(['question', 'user', 'test'])->get();
                return $data[] = [$results, $users, $tests];
            } else {
                //we have user filtering just
                $results = QuestionsResult::with(['question', 'user', 'test'])->whereHas('user', function (Builder $q) use ($array) {
                    $q->where('id', $array[1]);
                })->get();
                return $data[] = [$results, $users, $tests, $array];
            }
            return 'no selected test';
        } else {
            if ($array[1] == '') {
                //no user filtering
                $results = QuestionsResult::with(['question', 'user', 'test'])->whereHas('test', function (Builder $q) use ($array) {
                    $q->where('id', $array[0]);
                })->get();
                return $data[] = [$results, $users, $tests];
            } else {
                $results = QuestionsResult::with(['question', 'user', 'test'])->whereHas('test', function (Builder $q) use ($array) {
                    $q->where('id', $array[0]);
                })->whereHas('user', function (Builder $q) use ($array) {
                    $q->where('id', $array[1]);
                })->get();
                return $data[] = [$results, $users, $tests];
            }
        }
    }

    public function getStartTimeApi($id)
    {
        $test = Tests::find($id);
        return $test->startTime;
    }
}
