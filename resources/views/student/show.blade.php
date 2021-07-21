@extends('admin.layouts.master')

@section('context')
    <center>
        @if (\Illuminate\Support\Facades\Session::has('result-save'))
            <div class="alert alert-success">
                {{session('result-save')}}
            </div>
        @endif
        @if (\Illuminate\Support\Facades\Session::has('answer-false'))
            <div class="alert alert-danger">
                {{session('answer-false')}}
            </div>
        @endif
        @if (\Illuminate\Support\Facades\Session::has('result-delay'))
            <div class="alert alert-danger">
                {{session('result-delay')}}
            </div>
        @endif
        @if (\Illuminate\Support\Facades\Session::has('result-forbidden'))
            <div class="alert alert-danger">
                {{session('result-forbidden')}}
            </div>
        @endif
        @if (\Illuminate\Support\Facades\Session::has('test-end'))
            <div class="alert alert-danger">
                {{session('test-end')}}
            </div>
        @endif


        @if($currentPage==$totalPage)
            <div class="alert alert-warning">به سوال آخر رسیدیم</div>
        @endif
        @if($errors->all())
            <div class="alert alert-danger">
                به همگی سوالات بایست جواب دهید
            </div>
        @endif


        @if($currentPage>4)

            @if(\Illuminate\Support\Facades\Auth::user()->is_teacher == '1')

                @if (\Illuminate\Support\Facades\Session::has('question-not-end'))
                    <div class="alert alert-warning">
                        {{session('question-not-end')}}
                    </div>
                @endif

                <div class="alert alert-info">
                    زمان پایان آزمون: {{\Hekmatinasser\Verta\Facades\Verta::instance($data[0]->test->endTime)}}
                </div>
                <div class="alert alert-info">این آزمون شامل {{$Qcount}} سوال است</div>
                <div class="alert alert-warning">کاربر گرامی دقت داشته باشید که بعد از زمان تعیین شده برای پاسخگویی هر
                    سوال
                    جواب آن
                    با نمره ی کمتر ذخیره خواهد شد
                </div>
                @if(count($data)!=0)
                    <h1>آزمون {{$data[0]->test->name}}</h1>
                    <form action="{{route('result.check')}}" method="post">
                        @csrf
                        <input type="hidden" value="{{$data[0]->test->id}}" name="testId">
                        @foreach($data as $d)

                            <div class="col-md-12">
                                <div class="box">
                                    <div class="box-header with-border">
                                        @if($currentPage==$totalPage)
                                            <h4>سوال {{$currentPage}} (سوال آخر)</h4>
                                        @else
                                            <h4>سوال {{$currentPage}} </h4>
                                        @endif
                                        <h3 class="box-title">{!! $d->question !!}</h3><br>
                                        <span style="color: red">{{$d->TimeToAnswer*60}} ثانیه مهلت پاسخگویی </span><br>
                                        <span style="color: #00b9e7">نمره: {{$d->QuestionStar}} </span>
                                        <p> از درس( {{$d->lesson->name}})</p>
                                        <img width="200px" src="{{asset("uploads/photos/question/$d->photo_path")}}"
                                             alt="سوال عکس ندارد">
                                    </div>

                                    <div class="box-body">
                                        <table class="table table-bordered">
                                            <tr>
                                                <td>1.</td>
                                                <td><label
                                                        style="resize: vertical;width: 900px;">{{$d->answer1}}</label>
                                                </td>
                                                <td>
                                                    <input type="radio" name="answers[answerOf,{{$d->id}}]" value="1"
                                                           style="width: 20px;height: 20px;background: white;border-radius: 5px;border: 2px solid #555;">
                                                </td>

                                            </tr>
                                            <tr>
                                                <td>2.</td>
                                                <td><label
                                                        style="resize: vertical;width: 900px;">{{$d->answer2}}</label>
                                                </td>
                                                <td>
                                                    <input type="radio" name="answers[answerOf,{{$d->id}}]" value="2"
                                                           style="width: 20px;height: 20px;background: white;border-radius: 5px;border: 2px solid #555;">
                                                </td>

                                            </tr>
                                            <tr>
                                                <td>3.</td>
                                                <td><label
                                                        style="resize: vertical;width: 900px;">{{$d->answer3}}</label>
                                                </td>
                                                <td>
                                                    <input type="radio" name="answers[answerOf,{{$d->id}}]" value="3"
                                                           style="width: 20px;height: 20px;background: white;border-radius: 5px;border: 2px solid #555;">
                                                </td>

                                            </tr>

                                            <tr>
                                                <td>4.</td>
                                                <td><label
                                                        style="resize: vertical;width: 900px;">{{$d->answer4}}</label>
                                                </td>
                                                <td>
                                                    <input type="radio" name="answers[answerOf,{{$d->id}}]" value="4"
                                                           style="width: 20px;height: 20px;background: white;border-radius: 5px;border: 2px solid #555;"
                                                           class="mycheckbox">
                                                </td>

                                            </tr>

                                        </table>
                                    </div>

                                </div>
                                <center>
                                    <input type="submit" class="btn btn-success" value="ثبت پاسخ">
                                </center>
                                <br>
                                {{--                        @if($currentPage==$totalPage)--}}
                                {{--                            <center>--}}
                                {{--                                <input type="submit" name="endTest" class="btn btn-warning" value=" اتمام آزمون">--}}
                                {{--                            </center>--}}
                                {{--                        @endif--}}
                            </div>

                        @endforeach

                        <div class="col-md-12 pagination" style="text-align: center">
                            {{$data->links()}}
                        </div>

                    </form>
                @else
                    <div class="alert alert-info">این آزمون سوالی برایش طراحی نشده است</div>
                @endif


            @else
                @if(\Carbon\Carbon::now()->diffInDays(\Illuminate\Support\Facades\Auth::user()->created_at) <= 7)
                    <div class="alert alert-info">
                        زمان پایان آزمون: {{\Hekmatinasser\Verta\Facades\Verta::instance($data[0]->test->endTime)}}
                    </div>
                    <div class="alert alert-info">این آزمون شامل {{$Qcount}} سوال است</div>
                    <div class="alert alert-warning">کاربر گرامی دقت داشته باشید که بعد از زمان تعیین شده برای پاسخگویی
                        هر
                        سوال
                        جواب آن
                        با نمره ی کمتر ذخیره خواهد شد
                    </div>
                    @if(count($data)!=0)
                        <h1>آزمون {{$data[0]->test->name}}</h1>
                        <form action="{{route('result.check')}}" method="post">
                            @csrf
                            <input type="hidden" value="{{$data[0]->test->id}}" name="testId">
                            @foreach($data as $d)

                                <div class="col-md-12">
                                    <div class="box">
                                        <div class="box-header with-border">
                                            @if($currentPage==$totalPage)
                                                <h4>سوال {{$currentPage}} (سوال آخر)</h4>
                                            @else
                                                <h4>سوال {{$currentPage}} </h4>
                                            @endif
                                            <h3 class="box-title">{!! $d->question !!}</h3><br>
                                            <span style="color: red">{{$d->TimeToAnswer*60}} ثانیه مهلت پاسخگویی </span><br>
                                            <span style="color: #00b9e7">نمره: {{$d->QuestionStar}} </span>
                                            <p> از درس( {{$d->lesson->name}})</p>
                                            <img width="200px" src="{{asset("uploads/photos/question/$d->photo_path")}}"
                                                 alt="سوال عکس ندارد">
                                        </div>

                                        <div class="box-body">
                                            <table class="table table-bordered">
                                                <tr>
                                                    <td>1.</td>
                                                    <td><label
                                                            style="resize: vertical;width: 900px;">{{$d->answer1}}</label>
                                                    </td>
                                                    <td>
                                                        <input type="radio" name="answers[answerOf,{{$d->id}}]"
                                                               value="1"
                                                               style="width: 20px;height: 20px;background: white;border-radius: 5px;border: 2px solid #555;">
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td>2.</td>
                                                    <td><label
                                                            style="resize: vertical;width: 900px;">{{$d->answer2}}</label>
                                                    </td>
                                                    <td>
                                                        <input type="radio" name="answers[answerOf,{{$d->id}}]"
                                                               value="2"
                                                               style="width: 20px;height: 20px;background: white;border-radius: 5px;border: 2px solid #555;">
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td>3.</td>
                                                    <td><label
                                                            style="resize: vertical;width: 900px;">{{$d->answer3}}</label>
                                                    </td>
                                                    <td>
                                                        <input type="radio" name="answers[answerOf,{{$d->id}}]"
                                                               value="3"
                                                               style="width: 20px;height: 20px;background: white;border-radius: 5px;border: 2px solid #555;">
                                                    </td>

                                                </tr>

                                                <tr>
                                                    <td>4.</td>
                                                    <td><label
                                                            style="resize: vertical;width: 900px;">{{$d->answer4}}</label>
                                                    </td>
                                                    <td>
                                                        <input type="radio" name="answers[answerOf,{{$d->id}}]"
                                                               value="4"
                                                               style="width: 20px;height: 20px;background: white;border-radius: 5px;border: 2px solid #555;"
                                                               class="mycheckbox">
                                                    </td>

                                                </tr>

                                            </table>
                                        </div>

                                    </div>
                                    <center>
                                        <input type="submit" class="btn btn-success" value="ثبت پاسخ">
                                    </center>
                                    <br>
                                    {{--                        @if($currentPage==$totalPage)--}}
                                    {{--                            <center>--}}
                                    {{--                                <input type="submit" name="endTest" class="btn btn-warning" value=" اتمام آزمون">--}}
                                    {{--                            </center>--}}
                                    {{--                        @endif--}}
                                </div>

                            @endforeach

                            <div class="col-md-12 pagination" style="text-align: center">
                                {{$data->links()}}
                            </div>

                        </form>
                    @else
                        <div class="alert alert-info">این آزمون سوالی برایش طراحی نشده است</div>
                    @endif

                @else
                    @if(count(\App\Models\UserPlans::where('user_id', \Illuminate\Support\Facades\Auth::id())->get()) == 0)
                        <div style="color: red;background-color: yellow">شما حق دسترسی به این قسمت را
                            (بدلیل نداشتن اشتراک)ندارید
                        </div>
                    @else
                        @foreach(\App\Models\UserPlans::where('user_id', \Illuminate\Support\Facades\Auth::id())->get() as $plan)
                            @if(\Carbon\Carbon::now()->diffInDays($plan->created_at) <= $plan->plan->validityTime)
                                <div class="alert alert-info">
                                    زمان پایان
                                    آزمون: {{\Hekmatinasser\Verta\Facades\Verta::instance($data[0]->test->endTime)}}
                                </div>
                                <div class="alert alert-info">این آزمون شامل {{$Qcount}} سوال است</div>
                                <div class="alert alert-warning">کاربر گرامی دقت داشته باشید که بعد از زمان تعیین شده
                                    برای
                                    پاسخگویی هر سوال
                                    جواب آن
                                    با نمره ی کمتر ذخیره خواهد شد
                                </div>
                                @if(count($data)!=0)
                                    <h1>آزمون {{$data[0]->test->name}}</h1>
                                    <form action="{{route('result.check')}}" method="post">
                                        @csrf
                                        <input type="hidden" value="{{$data[0]->test->id}}" name="testId">
                                        @foreach($data as $d)

                                            <div class="col-md-12">
                                                <div class="box">
                                                    <div class="box-header with-border">
                                                        @if($currentPage==$totalPage)
                                                            <h4>سوال {{$currentPage}} (سوال آخر)</h4>
                                                        @else
                                                            <h4>سوال {{$currentPage}} </h4>
                                                        @endif
                                                        <h3 class="box-title">{!! $d->question !!}</h3><br>
                                                        <span
                                                            style="color: red">{{$d->TimeToAnswer*60}} ثانیه مهلت پاسخگویی </span><br>
                                                        <span style="color: #00b9e7">نمره: {{$d->QuestionStar}} </span>
                                                        <p> از درس( {{$d->lesson->name}})</p>
                                                        <img width="200px"
                                                             src="{{asset("uploads/photos/question/$d->photo_path")}}"
                                                             alt="سوال عکس ندارد">
                                                    </div>

                                                    <div class="box-body">
                                                        <table class="table table-bordered">
                                                            <tr>
                                                                <td>1.</td>
                                                                <td><label
                                                                        style="resize: vertical;width: 900px;">{{$d->answer1}}</label>
                                                                </td>
                                                                <td>
                                                                    <input type="radio"
                                                                           name="answers[answerOf,{{$d->id}}]"
                                                                           value="1"
                                                                           style="width: 20px;height: 20px;background: white;border-radius: 5px;border: 2px solid #555;">
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td>2.</td>
                                                                <td><label
                                                                        style="resize: vertical;width: 900px;">{{$d->answer2}}</label>
                                                                </td>
                                                                <td>
                                                                    <input type="radio"
                                                                           name="answers[answerOf,{{$d->id}}]"
                                                                           value="2"
                                                                           style="width: 20px;height: 20px;background: white;border-radius: 5px;border: 2px solid #555;">
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td>3.</td>
                                                                <td><label
                                                                        style="resize: vertical;width: 900px;">{{$d->answer3}}</label>
                                                                </td>
                                                                <td>
                                                                    <input type="radio"
                                                                           name="answers[answerOf,{{$d->id}}]"
                                                                           value="3"
                                                                           style="width: 20px;height: 20px;background: white;border-radius: 5px;border: 2px solid #555;">
                                                                </td>

                                                            </tr>

                                                            <tr>
                                                                <td>4.</td>
                                                                <td><label
                                                                        style="resize: vertical;width: 900px;">{{$d->answer4}}</label>
                                                                </td>
                                                                <td>
                                                                    <input type="radio"
                                                                           name="answers[answerOf,{{$d->id}}]"
                                                                           value="4"
                                                                           style="width: 20px;height: 20px;background: white;border-radius: 5px;border: 2px solid #555;"
                                                                           class="mycheckbox">
                                                                </td>

                                                            </tr>

                                                        </table>
                                                    </div>

                                                </div>
                                                <center>
                                                    <input type="submit" class="btn btn-success" value="ثبت پاسخ">
                                                </center>
                                                <br>
                                                {{--                        @if($currentPage==$totalPage)--}}
                                                {{--                            <center>--}}
                                                {{--                                <input type="submit" name="endTest" class="btn btn-warning" value=" اتمام آزمون">--}}
                                                {{--                            </center>--}}
                                                {{--                        @endif--}}
                                            </div>

                                        @endforeach

                                        <div class="col-md-12 pagination" style="text-align: center">
                                            {{$data->links()}}
                                        </div>

                                    </form>
                                @else
                                    <div class="alert alert-info">این آزمون سوالی برایش طراحی نشده است</div>
                                @endif

                            @endif
                        @endforeach
                        <div style="color: red;background-color: yellow">شما حق دسترسی به این قسمت را
                            ندارید(بدلیل اتمام اعتبار اشتراک)
                        </div>
                    @endif
                @endif
            @endif

        @else


            @if (\Illuminate\Support\Facades\Session::has('question-not-end'))
                <div class="alert alert-warning">
                    {{session('question-not-end')}}
                </div>
            @endif

            <div class="alert alert-info">
                زمان پایان آزمون: {{\Hekmatinasser\Verta\Facades\Verta::instance($data[0]->test->endTime)}}
            </div>
            <div class="alert alert-info">این آزمون شامل {{$Qcount}} سوال است</div>
            <div class="alert alert-warning">کاربر گرامی دقت داشته باشید که بعد از زمان تعیین شده برای پاسخگویی هر سوال
                جواب آن
                با نمره ی کمتر ذخیره خواهد شد
            </div>
            @if(count($data)!=0)
                <h1>آزمون {{$data[0]->test->name}}</h1>
                <form action="{{route('result.check')}}" method="post">
                    @csrf
                    <input type="hidden" value="{{$data[0]->test->id}}" name="testId">
                    @foreach($data as $d)

                        <div class="col-md-12">
                            <div class="box">
                                <div class="box-header with-border">
                                    @if($currentPage==$totalPage)
                                        <h4>سوال {{$currentPage}} (سوال آخر)</h4>
                                    @else
                                        <h4>سوال {{$currentPage}} </h4>
                                    @endif
                                    <h3 class="box-title">{!! $d->question !!}</h3><br>
                                    <span style="color: red">{{$d->TimeToAnswer*60}} ثانیه مهلت پاسخگویی </span><br>
                                    <span style="color: #00b9e7">نمره: {{$d->QuestionStar}} </span>
                                    <p> از درس( {{$d->lesson->name}})</p>
                                    <img width="200px" src="{{asset("uploads/photos/question/$d->photo_path")}}"
                                         alt="سوال عکس ندارد">
                                </div>

                                <div class="box-body">
                                    <table class="table table-bordered">
                                        <tr>
                                            <td>1.</td>
                                            <td><label style="resize: vertical;width: 900px;">{{$d->answer1}}</label>
                                            </td>
                                            <td>
                                                <input type="radio" name="answers[answerOf,{{$d->id}}]" value="1"
                                                       style="width: 20px;height: 20px;background: white;border-radius: 5px;border: 2px solid #555;">
                                            </td>

                                        </tr>
                                        <tr>
                                            <td>2.</td>
                                            <td><label style="resize: vertical;width: 900px;">{{$d->answer2}}</label>
                                            </td>
                                            <td>
                                                <input type="radio" name="answers[answerOf,{{$d->id}}]" value="2"
                                                       style="width: 20px;height: 20px;background: white;border-radius: 5px;border: 2px solid #555;">
                                            </td>

                                        </tr>
                                        <tr>
                                            <td>3.</td>
                                            <td><label style="resize: vertical;width: 900px;">{{$d->answer3}}</label>
                                            </td>
                                            <td>
                                                <input type="radio" name="answers[answerOf,{{$d->id}}]" value="3"
                                                       style="width: 20px;height: 20px;background: white;border-radius: 5px;border: 2px solid #555;">
                                            </td>

                                        </tr>

                                        <tr>
                                            <td>4.</td>
                                            <td><label style="resize: vertical;width: 900px;">{{$d->answer4}}</label>
                                            </td>
                                            <td>
                                                <input type="radio" name="answers[answerOf,{{$d->id}}]" value="4"
                                                       style="width: 20px;height: 20px;background: white;border-radius: 5px;border: 2px solid #555;"
                                                       class="mycheckbox">
                                            </td>

                                        </tr>

                                    </table>
                                </div>

                            </div>
                            <center>
                                <input type="submit" class="btn btn-success" value="ثبت پاسخ">
                            </center>
                            <br>
                            {{--                        @if($currentPage==$totalPage)--}}
                            {{--                            <center>--}}
                            {{--                                <input type="submit" name="endTest" class="btn btn-warning" value=" اتمام آزمون">--}}
                            {{--                            </center>--}}
                            {{--                        @endif--}}
                        </div>

                    @endforeach

                    <div class="col-md-12 pagination" style="text-align: center">
                        {{$data->links()}}
                    </div>

                </form>
            @else
                <div class="alert alert-info">این آزمون سوالی برایش طراحی نشده است</div>
            @endif


        @endif


    </center>
@endsection

