<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\Models\UserPlans;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserSpecialAccess
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::user()->is_teacher == '1') {
            return $next($request);
        } else {
            if (Carbon::now()->diffInDays(Auth::user()->created_at) <= 7) {
                return $next($request);
            } else {
                if (count(UserPlans::where('user_id', Auth::id())->get()) == 0) {
                    \Illuminate\Support\Facades\Session::flash('access-error', "از مدت زمان ایجاد حساب شما 7 روز بیشتر گذشته است و شما دارای هیچ اشتراکی نمیباشید و لذا حق دسترسی به این قسمت را ندارید!");
                    return redirect()->to('/');
                } else {
                    foreach (UserPlans::where('user_id', Auth::id())->get() as $plan) {
                        if (Carbon::now()->diffInDays($plan->created_at) <= $plan->plan->validityTime) {
                            return $next($request);
                        }
                    }
                    \Illuminate\Support\Facades\Session::flash('access-error', "از مدت زمان ایجاد حساب شما 7 روز بیشتر گذشته است و همچنین اعتبار طرح های خریداری شده ی شما به پایان رسیده است ، لذا حق دسترسی به این قسمت را ندارید!");
                    return redirect()->to('/');
                }
            }
        }
    }
}
