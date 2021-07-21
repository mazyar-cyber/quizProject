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
                    <h2 class="box-title">لیست لینک ها </h2>
                    <br><br>
                    @if (\Illuminate\Support\Facades\Session::has('link-delete'))
                        <div class="alert alert-success">
                            {{session('link-delete')}}
                        </div>
                    @endif
                    <a class="btn btn-app pull-left" href="{{route('video.link.create')}}">
                        <i class="fa fa-plus"></i> جدید
                    </a>

                </div>

                <div class="box-body table-responsive no-padding">
                    {!! Form::open(['route' => 'video.link.selectedDel', 'method' => 'POST']) !!}

                    <select name="checkBoxArray" class="select2-dropdown">
                        <option value="delete">حذف</option>
                    </select>
                    <input type="submit" value="اعمال" name="submit" class="btn btn-danger">
                    <br>
                    @if(count($links)!=0)
                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <th><input type="checkbox" name="checkBoxArray" id="option3"></th>
                                <th> عنوان</th>
                                <th>لینک ویدیو</th>
                                <th>مشاهده ویدیو</th>
                                <th> تاریخ ایجاد</th>
                                <th> تاریخ ویرایش</th>
                            </tr>

                            @foreach($links as $link)
                                <tr>
                                    <td><input class="checkBox" type="checkbox" name="checkBoxArray[]"
                                               value="{{$link->id}}"></td>

                                    <td>{!! $link->title !!}</td>
                                    <td><a href="{{$link->link}}" target="_blank"><span
                                                class="fa fa-unlink"></span></a></td>
                                    <td><a href="{{route('video.link',$link->id)}}" target="_blank"><span
                                                class="fa fa-play"></span></a></td>
                                    <td>
                                        {{\Hekmatinasser\Verta\Verta::today($link->created_at) }}
                                    </td>

                                    <td>
                                        {{\Hekmatinasser\Verta\Verta::today($link->updated_at) }}
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
