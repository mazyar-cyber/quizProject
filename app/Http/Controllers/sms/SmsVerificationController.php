<?php

namespace App\Http\Controllers\sms;

use App\Http\Controllers\Controller;
use App\Http\Requests\SmsSendRequest;
use Illuminate\Http\Request;
use http\Client\Curl\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Kavenegar\KavenegarApi;
use Kavenegar;

class SmsVerificationController extends Controller
{
    protected $message;
    protected $MessageStatus;

    /**
     * @param Request $request
     */
    public function send(SmsSendRequest $request)
    {

        //check  phone number
        $user = \App\Models\User::where('phoneNumber', $request->phoneNumber)->first();
        if ($user == null) {
            \Illuminate\Support\Facades\Session::flash('phoneNumber-error', "هیچ کاربری با این شماره تلفن در دیتا بیس وجود ندارد!");
            return redirect()->to('/password/reset');
        }
        //check  phone number
        $token = env('KaveNegarApiToken');
        $receptor = $user->phoneNumber;
        $code = rand(10000000, 99999999);
        $url = "https://api.kavenegar.com/v1/" . $token . "/verify/lookup.json?receptor=" . $receptor . "&token=" . "$code" . "&template=verifySms";
        $response = Http::get($url);
        $this->MessageStatus = $response->status();
        $user->resetPassword = Hash::make($code);
        $user->password = Hash::make($code);
        $user->save();
        \Illuminate\Support\Facades\Session::flash('smsVerificationSuccessful', "رمز عبور جدید با موفقیت ارسال شد!");
        return redirect()->to('/password/reset');
    }

    public function show()
    {

        $user = \App\Models\User::find(Auth::id());
        if ($user->phone_number_verify) {
            return redirect()->to('/');
        }
        $token = env('KaveNegarApiToken');
        $receptor = $user->phoneNumber;
        $code = rand(10000000, 99999999);
        $url = "https://api.kavenegar.com/v1/" . $token . "/verify/lookup.json?receptor=" . $receptor . "&token=" . "$code" . "&template=verifySms";
        $response = Http::get($url);
        $user->ValidationCodeSent = $code;
        $user->save();
        return view('sms.verify');
    }

    public function check(Request $request)
    {
        $code = $request->code;
        if ($code == Auth::user()->ValidationCodeSent) {
            $user = \App\Models\User::find(Auth::id());
            $user->phone_number_verify = 'true';
            $user->save();
            \Illuminate\Support\Facades\Session::flash('validation-Success', "اعتبار سنجی شما با موفقیت انجام شد!");
            return redirect()->to('/');
        } else {
            \Illuminate\Support\Facades\Session::flash('validation-danger', "اعتبار سنجی شما انجام نشد!");
            return redirect()->back();
        }

    }


}
