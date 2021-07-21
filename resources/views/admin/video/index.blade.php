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
                    <h2 class="box-title">لیست ویدیو ها </h2>
                    <br><br>
                    @if (\Illuminate\Support\Facades\Session::has('question-delete'))
                        <div class="alert alert-success">
                            {{session('video-delete')}}
                        </div>
                    @endif
                    <a class="btn btn-app pull-left" href="{{route('video.create')}}">
                        <i class="fa fa-plus"></i> جدید
                    </a>

                </div>

                <div class="box-body table-responsive no-padding">
                    {!! Form::open(['route' => 'video.selectedDel', 'method' => 'POST']) !!}

                    <select name="checkBoxArray" class="select2-dropdown">
                        <option value="delete">حذف</option>
                    </select>
                    <input type="submit" value="اعمال" name="submit" class="btn btn-danger">
                    <br>
                    @if(count($videos)!=0)
                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <th><input type="checkbox" name="checkBoxArray" id="option3"></th>
                                <th> عنوان</th>
                                <th> تماشای ویدیو</th>
                                <th> تاریخ ایجاد</th>
                                <th> تاریخ ویرایش</th>
                                <th> ویرایش</th>
                            </tr>

                            @foreach($videos as $video)
                                <tr>
                                    <td><input class="checkBox" type="checkbox" name="checkBoxArray[]"
                                               value="{{$video->id}}"></td>

                                    <td>{!! $video->title !!}</td>
                                    <td><a href="{{route('video.show',$video->id)}}">here</a></td>
                                    <td>
                                        {{\Hekmatinasser\Verta\Verta::today($video->created_at) }}
                                    </td>

                                    <td>
                                        {{\Hekmatinasser\Verta\Verta::today($video->updated_at) }}
                                    </td>

                                    <td>
                                        <a href="/admin/video/{{$video->id}}/edit"
                                           class="btn btn-instagram">ویرایش</a>
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="alert alert-info">
                            ویدیویی برای نمایش وجود ندارد
                        </div>
                @endif


                <!-- /.box-body -->

                </div>
                <!-- /.box -->
            </div>
        </div>

@endsection
