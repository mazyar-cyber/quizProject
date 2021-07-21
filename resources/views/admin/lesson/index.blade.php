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
    <div class="alert alert-warning">توجه:با حذف درس سوالات مربوط به درس نیز حذف خواهند شد</div>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h2 class="box-title">لیست درس ها </h2>
                    <br><br>
                    @if (\Illuminate\Support\Facades\Session::has('lesson-delete'))
                        <div class="alert alert-success">
                            {{session('lesson-delete')}}
                        </div>
                    @endif
                    <a class="btn btn-app pull-left" href="{{route('lesson.create')}}">
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
                    {!! Form::open(['route' => 'lesson.selectedDel', 'method' => 'POST']) !!}

                    <select name="checkBoxArray" class="select2-dropdown">
                        <option value="delete">حذف</option>
                    </select>
                    <input type="submit" value="اعمال" name="submit" class="btn btn-danger">
                    <br>
                    @if(count($lessons)!=0)
                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <th><input type="checkbox" name="checkBoxArray" id="option3"></th>
                                <th>نام درس</th>
                                <th> تاریخ ایجاد</th>
                                <th> تاریخ ویرایش</th>
                                <th> ویرایش</th>
                            </tr>

                            @foreach($lessons as $lesson)
                                <tr>
                                    <td><input class="checkBox" type="checkbox" name="checkBoxArray[]"
                                               value="{{$lesson->id}}"></td>

                                    <td>{{$lesson->name}}</td>

                                    <td>
                                        {{\Hekmatinasser\Verta\Verta::today($lesson->created_at) }}
                                    </td>

                                    <td>
                                        {{\Hekmatinasser\Verta\Verta::today($lesson->updated_at) }}
                                    </td>

                                    <td>
                                        <a href="lesson/{{$lesson->id}}/edit"
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
