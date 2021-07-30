<?php

use App\Models\Order_Plans;
use App\Models\Questions;
use App\Models\Tests;
use App\Models\User;
use App\Models\UserPlans;
use App\Models\UserQuestionStartingTime;
use App\Models\UserStar;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Hekmatinasser\Verta\Verta;
use Illuminate\Database\Eloquent\Builder;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//testing
Route::get('testing', function () {
    return 'here is testing route!';
//    return $lastLink = \App\Models\Links::latest()->first()->link;
//    $q = \App\Models\Questions::with('test')->get();
//    $test = \App\Models\Tests::with('questions')->where('id', 17)->first();
//    $time = 0;
//    foreach ($test->questions as $q) {
//        $time = $time + $q->TimeToAnswer;
//    }
//    echo $time . '...';
//    echo $test->expiration;

//    $q = \App\Models\QuestionsResult::find(2);
//    $l = \App\Models\Lessons::find(2);
//    return $test;
//    return 10 * (20 / 10);
//    return $l->question;
//    return \Illuminate\Support\Facades\Auth::user();
//    return $q->question;
})->middleware('specialAccess');
//end testing

Route::get('test', function () {
//     UserPlans::where('user_id', Auth::id())->get();
//    foreach (UserPlans::where('user_id', Auth::id())->get() as $plan) {
//        if (Carbon::now()->diffInDays($plan->created_at) <= $plan->plan->validityTime) {
//            echo 'yes.';
//        }
//    }
});

Route::middleware(['auth', 'smsVerify'])->group(function () {
    Route::get('/', function () {
        return view('guide.index');
    });
    Route::get('/homePage/{id}', function ($id = null) {
        return view('guide.index', compact('id'));
    });
    Route::get('changeUserPhoneNumber', [\App\Http\Controllers\admin\UserController::class, 'showChangePhoneNumberPage']);
    Route::post('changePhoneNumber', [\App\Http\Controllers\admin\UserController::class, 'changePhoneNumber'])->name('change.number');


    Route::get('/spin', function () {
        if ($modelExistence = UserStar::where('user_id', Auth::id())->first()) {
            $now = Carbon::now();
            if ($now->diffInHours($modelExistence->updated_at) < 24) {
                \Illuminate\Support\Facades\Session::flash('spin-error', "شما در 24 ساعت اخیر شانس خود را امتحان کرده اید");
                return redirect()->to('/');
            }

        }
        return view('student.spin');
    })->middleware('specialAccess');
    Route::get('/video', [\App\Http\Controllers\admin\VideoController::class, 'watchVideo'])->middleware('specialAccess');
    Route::get('video/showLink/{id}', [\App\Http\Controllers\admin\VideoController::class, 'showStudent'])->name('video.link');
    Route::prefix('api')->group(function () {
        {
            Route::get('spin/{id}', [\App\Http\Controllers\student\ResultController::class, 'spin']);
        }
    });
    Route::middleware('isTeacher')->group(function () {
        Route::prefix('/admin')->group(function () {
            Route::resource('guide', \App\Http\Controllers\admin\GuideController::class);
            Route::get('/guideSpinner', [\App\Http\Controllers\admin\GuideController::class, 'createSpinGuide'])->name('guide.createSpin');
            Route::post('/guideSpinner', [\App\Http\Controllers\admin\GuideController::class, 'storeSpinnerGuide'])->name('guide.storeSpin');
            Route::get('userStar', function () {
                $data = \App\Models\UserStar::with('user')->get();
                return view('admin.userStar.index', compact('data'));
            })->name('user.star');
            Route::get('order', [\App\Http\Controllers\admin\OrderController::class, 'index'])->name('order.index');
            Route::resource('pdf', \App\Http\Controllers\admin\PdfController::class);
            Route::resource('plan', \App\Http\Controllers\admin\PlanController::class);
            Route::resource('user', \App\Http\Controllers\admin\UserController::class);
            Route::resource('video', \App\Http\Controllers\admin\VideoController::class);
            Route::get('video/link/create', [\App\Http\Controllers\admin\VideoController::class, 'createLink'])->name('video.link.create');
            Route::get('video/link/index', [\App\Http\Controllers\admin\VideoController::class, 'indexLink'])->name('video.link.index');
            Route::post('video/link/store', [\App\Http\Controllers\admin\VideoController::class, 'storeLink'])->name('video.link.store');
            Route::resource('question', \App\Http\Controllers\admin\QuestionController::class);
            Route::resource('lesson', \App\Http\Controllers\admin\LessonController::class);
            Route::resource('test', \App\Http\Controllers\admin\TestContrller::class);
            Route::post('questionDeleteSelected', [\App\Http\Controllers\admin\QuestionController::class, 'deleteSelected'])->name('question.selectedDel');
            Route::post('planDeleteSelected', [\App\Http\Controllers\admin\PlanController::class, 'deleteSelected'])->name('plan.selectedDel');
            Route::post('videoDeleteSelected', [\App\Http\Controllers\admin\VideoController::class, 'deleteSelected'])->name('video.selectedDel');
            Route::post('pdfDeleteSelected', [\App\Http\Controllers\admin\PdfController::class, 'deleteSelected'])->name('pdf.selectedDel');
            Route::post('videoLinkDeleteSelected', [\App\Http\Controllers\admin\VideoController::class, 'deleteSelectedLink'])->name('video.link.selectedDel');
            Route::post('testDeleteSelected', [\App\Http\Controllers\admin\TestContrller::class, 'deleteSelected'])->name('test.selectedDel');
            Route::post('userDeleteSelected', [\App\Http\Controllers\admin\UserController::class, 'deleteSelected'])->name('user.selectedDel');
            Route::post('lessonDeleteSelected', [\App\Http\Controllers\admin\LessonController::class, 'deleteSelected'])->name('lesson.selectedDel');
            Route::get('/testResult', [\App\Http\Controllers\admin\TestContrller::class, 'showResult'])->name('testResult');
        });

        Route::prefix('/api')->group(function () {
            Route::get('getTestTime/{id}', [\App\Http\Controllers\admin\TestContrller::class, 'getStartTimeApi']);
            Route::get('getResults/{sort}', [\App\Http\Controllers\admin\TestContrller::class, 'showResultApi']);
            Route::get('searchResults/{type}/{searchWord}', [\App\Http\Controllers\admin\TestContrller::class, 'searchResultApi']);
            Route::get('searchResults2/{type}', [\App\Http\Controllers\admin\TestContrller::class, 'searchResultApi2']);
        });
    });

    Route::get('pdfStudent', [\App\Http\Controllers\admin\PdfController::class, 'indexStudent'])->name('pdfStudent.index')->middleware('specialAccess');
    Route::post('/order', [\App\Http\Controllers\student\OrderController::class, 'store'])->name('order.store');
    Route::get("/payment/{id}", [\App\Http\Controllers\student\PaymentController::class, 'verify'])->name('payment.verify');
    Route::get('/planShow', [\App\Http\Controllers\admin\PlanController::class, 'indexStudent'])->name('plan.student');
    Route::post('/profile/photo', [\App\Http\Controllers\admin\UserController::class, 'photo'])->name('user.profile.photo');
    Route::get('/profile', [\App\Http\Controllers\admin\UserController::class, 'show'])->name('user.profile');
    Route::resource('/result', \App\Http\Controllers\student\ResultController::class);
    Route::post('/result/check', [\App\Http\Controllers\student\ResultController::class, 'check'])->name('result.check');
    Route::get('/result/show/user/{id}', [\App\Http\Controllers\student\ResultController::class, 'showUserResult'])->name('result.show.user');
});


Route::post('/sendingVerificationCode', [\App\Http\Controllers\sms\SmsVerificationController::class, 'send']);
Route::get('/smsVerifyNumber', [\App\Http\Controllers\sms\SmsVerificationController::class, 'show'])->middleware('auth');
Route::post('checkSmsCode', [\App\Http\Controllers\sms\SmsVerificationController::class, 'check'])->name('check.sms');
Route::get('/logout', function () {
    \Illuminate\Support\Facades\Auth::logout();
    return redirect()->to('/');
});
//
Route::get('/check', function () {
    return $user = User::find(6);
    dd(User::find(Auth::id())->phone_number_verify);
//    $payablePrice = Order_Plans::where('order_id', 1)->where('user_id', 4)->first();
//    return $payablePrice->plan->star;
//    return env('ZARINPAL_CALLbACK_URL');
})->middleware(['auth', 'smsVerify']);


