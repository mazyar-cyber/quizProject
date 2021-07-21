<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PlanStoreRequest;
use App\Http\Requests\PlanUpdateRequest;
use App\Models\Plans;
use App\Models\Questions;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plans = Plans::all();
        return view('admin.plans.index', compact('plans'));
    }

    public function indexStudent()
    {
        $plans = Plans::all();
        return view('student.plan', compact('plans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.plans.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(PlanStoreRequest $request)
    {
        $plan = new Plans();
        $plan->name = $request->name;
        $plan->description = $request->description;
        $plan->validityTime = $request->validityTime;
        $plan->price = $request->price;
        $plan->save();
        \Illuminate\Support\Facades\Session::flash('plan-save', " طرح شما ایجاد شد!");
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
        $plan = Plans::find($id);
        return view('admin.plans.edit', compact('plan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(PlanUpdateRequest $request, $id)
    {
        $plan = Plans::find($id);
        $plan->name = $request->name;
        $plan->description = $request->description;
        $plan->validityTime = $request->validityTime;
        $plan->price = $request->price;
        $plan->save();
        \Illuminate\Support\Facades\Session::flash('plan-edit', " طرح شما ویرایش شد!");
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
            $q = Plans::find($id);
            $q->delete();
        }
        \Illuminate\Support\Facades\Session::flash('plan-delete', " طرح های انتخاب شده شما با موفقیت حذف شدند!");
        return redirect()->back();
    }
}
