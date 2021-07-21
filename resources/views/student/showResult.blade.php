@extends('admin.layouts.master')
@section('context')

    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"> نتیجه ی
                    آزمون {{$test->name}} {{\Illuminate\Support\Facades\Auth::user()->name}} </h3>
            </div>
            <!-- /.box-header -->
            @if(count($result)!=0)
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody>
                        <tr>
                            <th>صورت سوال</th>
                            <th>جواب شما</th>
                            <th>وضعیت</th>
                            <th>زمان پاسخگویی به سوال</th>
                            <th>مدت زمان تاخیر</th>
                            <th>نمره گرفته شده</th>
                            <th>کل نمره سوال </th>
                            <th>تاریخ</th>
                        </tr>
                        @foreach($result as $r)
                            <tr>
                                <td>  {!!$r->question->question  !!}</td>
                                <td> گزینه{{$r->userAnswer}} </td>
                                <td>
                                    @if($r->answerStatus=='true')
                                        <span class="label label-success"> صحیح</span>
                                    @else
                                        <span class="label label-danger"> غلط</span>
                                    @endif
                                </td>
                                <td>
                                    {{$r->question->TimeToAnswer}}دقیقه
                                </td>
                                <td>
                                    @if($r->relative_delay_timeAnswering)
                                        {{$r->relative_delay_timeAnswering*$r->question->TimeToAnswer}}
                                    @else
                                        <span>0</span>
                                    @endif

                                </td>
                                <td>
                                    {{$r->star}}
                                </td>
                                <td>
                                    {{$r->question->QuestionStar}}
                                </td>
                                <td>{{$r->created_at}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            @else
                <div class="alert alert-info">نتیجه ای برای این آزمون برای شما در دسترس نیست</div>
            @endif

        </div>
    </div>
@endsection
