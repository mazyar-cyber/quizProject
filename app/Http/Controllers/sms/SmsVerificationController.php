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


}
