<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use App\Models\Order_Plans;
use App\Models\Orders;
use App\Models\Payment;
use App\Models\UserPlans;
use App\Models\UserStar;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\String_;

class PaymentController extends Controller
{
    public function verify(Request $request, $id)
    {
        $model = Order_Plans::where('order_id', $id)->where('user_id', Auth::id())->first();
        $planStar = $model->plan->star;
        $payablePrice = $model->order->amount;
        $payment = new Payment((string)$payablePrice);
        $result = $payment->verifyPayment((string)$request->Authority, $request->Status);
        if ($result) {
            $order = Orders::findOrfail($id);
            $order->status = '1';
            $order->save();
            $newPayment = new Payment((string)$payablePrice);
            $newPayment->authority = $request->Authority;
            $newPayment->status = $request->Status;
            $newPayment->RefId = $result->RefID;
            $newPayment->order_id = $id;
            $newPayment->save();
            $userPlan = UserPlans::where('user_id', Auth::id())->where('plan_id', $model->plan->id)->first();
            if ($userPlan) {
                $userPlan->created_at = Carbon::now();
                $userPlan->save();
                \Illuminate\Support\Facades\Session::flash('payment-successful', "خرید شما با موفقیت انجام شد و طرح مورد نظر برایتان تمدید  شد!");
            } else {
                $userPlan = new UserPlans();
                $userPlan->user_id = Auth::id();
                $userPlan->plan_id = $model->plan->id;
                $userPlan->save();
                \Illuminate\Support\Facades\Session::flash('payment-successful', "خرید شما با موفقیت انجام شد و طرح مورد نظر برایتان فعال شد");
            }
        } else {
            \Illuminate\Support\Facades\Session::flash('payment-error', "در پرداخت شما مشکل پیش آمد دوباره تلاش نمایید!");

        }
        return redirect()->to('/planShow');
    }
}
