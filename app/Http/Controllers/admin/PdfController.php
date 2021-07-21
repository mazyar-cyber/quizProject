<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PdfStoreRequest;
use App\Models\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PdfController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pdfs = Pdf::all();
        return view('admin.pdf.index', compact('pdfs'));
    }

    public function indexStudent()
    {
        $pdfs = Pdf::all();
        return view('student.pdf', compact('pdfs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pdf.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(PdfStoreRequest $request)
    {
        $pdf = new Pdf();
        $pdf->name = $request->name;
        //uploading part
        $file = $request->file('file');
        $filename = time() . $file->getClientOriginalName();
        Storage::disk('public')->putFileAs('/pdf', $file, $filename);
        $pdf->path = $filename;
        $pdf->save();
        //end uploading part
        \Illuminate\Support\Facades\Session::flash('pdf-save', "pdf شما با موفقیت ذخیره شد");
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
        $pdf = Pdf::find($id);
        return view('admin.pdf.edit', compact('pdf'));
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
        $pdf = Pdf::find($id);
        $pdf->name = $request->name;
        $pdf->save();
        \Illuminate\Support\Facades\Session::flash('pdf-edit', "pdf شما با موفقیت ویرایش شد");
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
            $v = Pdf::find($id);
            unlink("uploads/pdf/$v->path");
            $v->delete();
        }
        \Illuminate\Support\Facades\Session::flash('video-delete', " pdf های انتخاب شده شما با موفقیت حذف شدند!");
        return redirect()->back();
    }
}
