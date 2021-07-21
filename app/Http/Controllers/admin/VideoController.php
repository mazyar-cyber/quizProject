<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLinkRequest;
use App\Http\Requests\VideoRequest;
use App\Models\Links;
use App\Models\Questions;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videos = Video::all();
        $links = Links::all();
        return view('admin.video.index', compact(['videos', 'links']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.video.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(VideoRequest $request)
    {
        $video = new Video();
        $video->title = $request->title;
        //uploading part
        $file = $request->file('video');
        $filename = time() . $file->getClientOriginalName();
        Storage::disk('public')->putFileAs('/videos', $file, $filename);
        $video->path = $filename;
        $video->save();
        //end uploading part
        \Illuminate\Support\Facades\Session::flash('video-save', "ویدیو شما با موفقیت ذخیره شد");
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
        $video = Video::find($id);
        return view('admin.video.show', compact('video'));
    }

    public function showStudent($id)
    {
        $link = Links::findOrfail($id);
        return view('student.showVideoOfLink', compact('link'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $video = Video::find($id);
        return view('admin.video.edit', compact('video'));
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
        $video = Video::find($id);
        $video->title = $request->title;
        $video->save();
        \Illuminate\Support\Facades\Session::flash('video-edit', "ویدیو با موفقیت ذخیره شد");
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
            $v = Video::find($id);
            unlink("uploads/videos/$v->path");
            $v->delete();
        }
        \Illuminate\Support\Facades\Session::flash('video-delete', " ویدیو های انتخاب شده شما با موفقیت حذف شدند!");
        return redirect()->back();
    }

    public function watchVideo()
    {
        $videos = Video::all();
        $links = Links::all();
        return view('student.videos', compact(['videos', 'links']));
    }

    public function createLink()
    {
        return view('admin.video.createLink');
    }

    public function indexLink()
    {
        $links = Links::all();
        return view('admin.video.indexLink', compact('links'));
    }

    public function storeLink(StoreLinkRequest $request)
    {
        $link = new Links();
        $link->title = $request->title;
        $link->link = $request->link;
        $link->save();
        \Illuminate\Support\Facades\Session::flash('link-save', "لینک مورد نظر شما با موفقیت ایجاد شد!");
        return redirect()->back();
    }

    public function deleteSelectedLink(Request $request)
    {
        foreach ($request->checkBoxArray as $id) {
            $v = Links::find($id);
            $v->delete();
        }
        \Illuminate\Support\Facades\Session::flash('link-delete', " لینک های  انتخاب شده شما با موفقیت حذف شدند!");
        return redirect()->back();
    }
}
