<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use App\Models\Order_Plans;
use App\Models\Order_Product;
use App\Models\Orders;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function store(Request $request)
    {

        $order = new Orders();
        $order->user_id = Auth::id();
        $order->status = '0';
        $order->amount = $request->amount;
        $order->save();


        $order_plans = new Order_Plans();
        $order_plans->order_id = $order->id;
        $order_plans->plan_id = $request->planId;
        $order_plans->user_id = Auth::id();
        $order_plans->save();


        $payment = new Payment((string)$request->amount, $order->id);
        $result = $payment->doPayment();
        if ($result->Status == 100) {
            return redirect()->to(env('ZarinPalStartPayPath') . $result->Authority);
        } else {
            echo 'ERR: ' . $result->Status;
        }

    }

}
