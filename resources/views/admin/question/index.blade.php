@extends('admin.layouts.master')
@section('script')
    <script type="text/javascript">
        $(document).ready(function () {
            $("#option3").click(function () {
                if (this.checked) {
                    $(".checkBox").each(function () {
                        this.checked = true
                    })
                } else {
                    $(".checkBox").each(function () {
                        this.checked = false
                    })
                }
            })
        })
    </script>
@endsection
@section('context')

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h2 class="box-title">لیست سوالات </h2>
                    <br><br>
                    @if (\Illuminate\Support\Facades\Session::has('question-delete'))
                        <div class="alert alert-success">
                            {{session('question-delete')}}
                        </div>
                    @endif
                    <a class="btn btn-app pull-left" href="{{route('question.create')}}">
                        <i class="fa fa-plus"></i> جدید
                    </a>
                    <div class="box-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control pull-right"
                                   placeholder="جستجو">

                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="box-body table-responsive no-padding">
                    {!! Form::open(['route' => 'question.selectedDel', 'method' => 'POST']) !!}

                    <select name="checkBoxArray" class="select2-dropdown">
                        <option value="delete">حذف</option>
                    </select>
                    <input type="submit" value="اعمال" name="submit" class="btn btn-danger">
                    <br>
                    @if(count($questions)!=0)
                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <th><input type="checkbox" name="checkBoxArray" id="option3"></th>
                                <th>صورت سوال</th>
                                <th>جواب اول</th>
                                <th>جواب دوم</th>
                                <th>جواب سوم</th>
                                <th>جواب چهارم</th>
                                <th>جواب درست</th>
                                <th>عکس</th>
                                <th>آزمون</th>
                                <th>درس</th>
                                <th>امتیاز</th>
                                <th>مدت زمان پاسخ دهی(دقیقه)</th>
                                <th>مدت زمان پاسخ دهی به <span style="color: #00e765">آزمون</span>(دقیقه)</th>
                                <th> تاریخ ایجاد</th>
                                <th> تاریخ ویرایش</th>
                                <th> ویرایش</th>
                            </tr>

                            @foreach($questions as $question)
                                <tr>
                                    <td><input class="checkBox" type="checkbox" name="checkBoxArray[]"
                                               value="{{$question->id}}"></td>

                                    <td>{!! $question->question !!}</td>
                                    <td>{{$question->answer1}}</td>
                                    <td>{{$question->answer2}}</td>
                                    <td>{{$question->answer3}}</td>
                                    <td>{{$question->answer4}}</td>
                                    <td>{{$question->trueAnswer}}</td>
                                    <td>
                                        <img src="{{asset("uploads/photos/question/$question->photo_path")}}"
                                             width="250px" alt="سوال عکس ندارد">
                                    </td>
                                    <td>
                                        <span style="color: yellow">{{$question->test->name}}</span>
                                    </td>
                                    <td>
                                        <span style="color: #0b93d5">{{$question->lesson->name}}</span>
                                    </td>
                                    <td>
                                        {{$question->QuestionStar}}
                                    </td>
                                    <td>
                                        {{$question->TimeToAnswer}}
                                    </td>
                                    <td>
                                        {{$question->test->expiration}}
                                    </td>
                                    <td>
                                        {{\Hekmatinasser\Verta\Verta::today($question->created_at) }}
                                    </td>

                                    <td>
                                        {{\Hekmatinasser\Verta\Verta::today($question->updated_at) }}
                                    </td>

                                    <td>
                                        <a href="question/{{$question->id}}/edit"
                                           class="btn btn-instagram">ویرایش</a>
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="alert alert-info">
                            موردی برای نمایش وجود ندارد
                        </div>
                    @endif
                    {!! Form::close() !!}
                </div>

                <!-- /.box-body -->

            </div>
            <!-- /.box -->
        </div>
    </div>

@endsection
