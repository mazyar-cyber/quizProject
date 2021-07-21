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
                    <h2 class="box-title"> سوالات مربوط به آزمون {{$tst->name}} </h2>
                    <br><br>
                    @if (\Illuminate\Support\Facades\Session::has('test-delete'))
                        <div class="alert alert-success">
                            {{session('test-delete')}}
                        </div>
                    @endif
                    <a class="btn btn-app pull-left" href="{{route('test.create')}}">
                        <i class="fa fa-plus"></i> جدید
                    </a>
                    <a class="btn btn-app pull-left" href="{{route('question.create')}}">
                            <i class="fa fa-plus"></i> طراحی سوال
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
                    {!! Form::open(['route' => 'test.selectedDel', 'method' => 'POST']) !!}

                    <select name="checkBoxArray" class="select2-dropdown">
                        <option value="delete">حذف</option>
                    </select>
                    <input type="submit" value="اعمال" name="submit" class="btn btn-danger">
                    <br>
                    @if(count($tst->questions)!=0)
                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <th><input type="checkbox" name="checkBoxArray" id="option3"></th>
                                <th> صورت سوال</th>
                                <th>جواب اول</th>
                                <th> جواب دوم</th>
                                <th> جواب سوم</th>
                                <th> جواب چهارم</th>
                                <th> جواب درست</th>
                                <th> عکس</th>
                                <th> تاریخ ایجاد</th>
                                <th> تاریخ ویرایش</th>
                                <th> ویرایش</th>
                            </tr>

                            @foreach($tst->questions as $q)
                                <tr>
                                    <td><input class="checkBox" type="checkbox" name="checkBoxArray[]"
                                               value="{{$q->id}}"></td>

                                    <td>{!! $q->question !!} </td>
                                    <td>{{$q->answer1}}</td>
                                    <td>{{$q->answer2}}</td>
                                    <td>{{$q->answer3}}</td>
                                    <td>{{$q->answer4}}</td>
                                    <td>{{$q->trueAnswer}} گزینه</td>

                                    </td>

                                    <td><img src="{{asset('uploads/photos/question/'.$q->photo_path)}}" width="250px"
                                             alt="سوال عکس ندارد"></td>

                                    <td>
                                        {{\Hekmatinasser\Verta\Verta::today($q->created_at) }}
                                    </td>

                                    <td>
                                        {{\Hekmatinasser\Verta\Verta::today($q->updated_at) }}
                                    </td>

                                    <td>
                                        <a href="/admin/question/{{$q->id}}/edit"
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
