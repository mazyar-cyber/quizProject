<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\changePhoneNumberRequest;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserEditRequest;
use App\Models\Tests;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $users = User::where('is_teacher', '0')->get();
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserCreateRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = time() . "a@a.com";
        $user->phoneNumber = $request->phoneNumber;
        $user->password = Hash::make($request->password);
        $user->is_teacher = $request->is_Teacher;
        $user->save();

        \Illuminate\Support\Facades\Session::flash('user-save', "کاربر با موفقیت ایجاد شد");
        return redirect()->back();
    }


    public function show()
    {
        $user = User::find(Auth::id());
        return view('student.profile', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserEditRequest $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = time() . 'a@a.com';
        $user->phoneNumber = $request->phoneNumber;
        $user->is_teacher = $request->is_Teacher;
        $user->password = Hash::make($request->password);
        $user->save();
        \Illuminate\Support\Facades\Session::flash('user-update', "کاربر با موفقیت ویرایش شد");
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
            $t = User::find($id);
            if ($t->email == Auth::user()->email) {
                \Illuminate\Support\Facades\Session::flash('cant-delete', "خودتان را نمیتوانید حذف کنید!");
                return redirect()->back();
            }
            if ($t->is_teacher == '0') {
                $t->delete();
                \Illuminate\Support\Facades\Session::flash('user-delete', "کاربران انتخاب شده شما با موفقیت حذف شدند!");
            } else {
                \Illuminate\Support\Facades\Session::flash('user-not-delete', "کاربران با سطح دسترسی ادمین حذف نمیشوند!");
            }
        }
        return redirect()->back();
    }

    public function photo(Request $request)
    {
        $user = User::find(Auth::id());
        //uploading part
        $file = $request->file('pic');
        $filename = time() . $file->getClientOriginalName();
        Storage::disk('public')->putFileAs('/photos/user', $file, $filename);
        $user->photo_path = $filename;
        $user->save();
        //end uploading part
        return redirect()->back();
    }


    public function showChangePhoneNumberPage()
    {
        $user = Auth::user();
        return view('admin.users.editPhoneNumber', compact('user'));
    }

    public function changePhoneNumber(changePhoneNumberRequest $request)
    {
        $user = User::find(Auth::id());
        $user->phoneNumber = $request->phoneNumber;
        $user->phone_number_verify = null;
        $user->save();
        \Illuminate\Support\Facades\Session::flash('user-edit', "شماره تلفن شما با موفقیت ویرایش شد!");
        return redirect()->back();
    }
}
