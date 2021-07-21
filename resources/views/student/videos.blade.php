@extends('admin.layouts.master')
@section('context')
    <div class="col-xs-12">
        <div class="box">
            <center>
                @foreach($videos as $video)
                    <h2>{{$video->title}}</h2>
                    <video width="520" height="440" controls>
                        <source src="{{asset("uploads/videos/$video->path")}}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                    <br>
                @endforeach
            </center>
        </div>

        <div class="box">
            <h3>لیست لینک ها</h3>
            @if(count($links)!=0)
                <table class="table table-hover">
                    <tbody>
                    <tr>
                        <th> عنوان</th>
                        <th> لینک ویدیو</th>
                        <th> مشاهده ویدیو</th>
                        <th> تاریخ ایجاد</th>
                        <th> تاریخ ویرایش</th>
                    </tr>

                    @foreach($links as $link)
                        <tr>

                            <td>{!! $link->title !!}</td>
                            <td><a href="{{$link->link}}" title="کلیک کنید" target="_blank"><span
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
        </div>
    </div>
    </div>
@endsection
