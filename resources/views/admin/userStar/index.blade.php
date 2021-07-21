@extends('admin.layouts.master')
@section('context')

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h2 class="box-title">لیست امتیازات کاربران </h2>
                    <br><br>
                </div>

                <div class="box-body table-responsive no-padding">

                    <select name="checkBoxArray" class="select2-dropdown">
                        <option value="delete">حذف</option>
                    </select>
                    <input type="submit" value="اعمال" name="submit" class="btn btn-danger">
                    <br>
                    @if(count($data)!=0)
                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <th> نام کاربر</th>
                                <th>امتیاز</th>
                                <th> تاریخ ایجاد</th>
                                <th> تاریخ ویرایش</th>
                            </tr>

                            @foreach($data as $d)
                                <tr>

                                    <td>{{$d->user->name}}</td>
                                    <td>
                                       {{$d->TotalScore}}
                                    </td>
                                    <td>
                                        {{\Hekmatinasser\Verta\Facades\Verta::instance($d->created_at)->formatDifference()}}
                                    </td>

                                    <td>
                                        {{\Hekmatinasser\Verta\Facades\Verta::instance($d->updated_at)->formatDifference()}}
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

                </div>

                <!-- /.box-body -->

            </div>
            <!-- /.box -->
        </div>
    </div>

@endsection
