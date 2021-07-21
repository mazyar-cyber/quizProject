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
                    <h2 class="box-title">لیست آزمون ها </h2>
                    <br><br>
                    @if (\Illuminate\Support\Facades\Session::has('test-delete'))
                        <div class="alert alert-success">
                            {{session('test-delete')}}
                        </div>
                    @endif
                    <a class="btn btn-app pull-left" href="{{route('test.create')}}">
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
                    {!! Form::open(['route' => 'test.selectedDel', 'method' => 'POST']) !!}

                    <select name="checkBoxArray" class="select2-dropdown">
                        <option value="delete">حذف</option>
                    </select>
                    <input type="submit" value="اعمال" name="submit" class="btn btn-danger">
                    <br>
                    @if(count($tests)!=0)
                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <th><input type="checkbox" name="checkBoxArray" id="option3"></th>
                                <th> نام آزمون</th>
                                <th>وضعیت</th>
                                <th> مدت زمان جوابدهی به آزمون</th>
                                <th>زمان شروع</th>
                                <th>زمان پایان</th>

                                <th></th>
                                <th> تاریخ ایجاد</th>
                                <th> تاریخ ویرایش</th>
                                <th> ویرایش</th>
                            </tr>

                            @foreach($tests as $test)
                                <tr>
                                    <td><input class="checkBox" type="checkbox" name="checkBoxArray[]"
                                               value="{{$test->id}}"></td>

                                    <td>{{$test->name}}</td>
                                    <td>
                                        @if($test->status==1)
                                            فعال
                                        @else
                                            غیرفعال
                                        @endif

                                    </td>
                                    <td>{{$test->expiration}} دقیقه</td>


                                    <td><span>{{($test->startTime)}}</span><br>
                                        <span
                                            style="color: yellowgreen">به هجری شمسی: {{\Hekmatinasser\Verta\Facades\Verta::instance($test->startTime)}}</span>
                                    </td>
                                    <td><span>{{$test->endTime}}</span><br>
                                        <span
                                            style="color: yellowgreen">به هجری شمسی: {{\Hekmatinasser\Verta\Facades\Verta::instance($test->endTime)}}</span>
                                    </td>

                                    <td><a href="{{route('test.show',$test->id)}}">مشاهده ی سوالات مربوط به آزمون</a>
                                    </td>

                                    <td>
                                        {{\Hekmatinasser\Verta\Facades\Verta::instance($test->created_at)->formatDifference()}}
                                    </td>

                                    <td>
                                        {{\Hekmatinasser\Verta\Facades\Verta::instance($test->updated_at)->formatDifference()}}
                                    </td>

                                    <td>
                                        <a href="{{route('test.edit',$test->id)}}"
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
