<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Guides;
use App\Models\SpinnerGuide;
use Illuminate\Http\Request;

class GuideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.guide.create');
    }

    public function createSpinGuide()
    {
        return view('admin.guide.create2');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $guide = new Guides();
        $guide->studentGuide = $request->desc;
        $guide->adminGuide = $request->desc2;
        $guide->save();
        \Illuminate\Support\Facades\Session::flash('guide-save', "عملیات موفقیت آمیز بود");
        return redirect()->back();
    }

    public function storeSpinnerGuide(Request $request)
    {
        $model = new SpinnerGuide();
        $model->description = $request->desc;
        $model->save();
        \Illuminate\Support\Facades\Session::flash('guide-save', "عملیات موفقیت آمیز بود");
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
}
