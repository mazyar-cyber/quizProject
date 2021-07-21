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
                    <h2 class="box-title">ویدیو {{$video->title}}</h2>
                    <br><br>
                    <center>
                        <video width="520" height="440" controls>
                            <source src="{{asset("uploads/videos/$video->path")}}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </center>
                    <a class="btn btn-app pull-left" href="{{route('test.create')}}">
                        <i class="fa fa-plus"></i> جدید
                    </a>
                    <a class="btn btn-app pull-left" href="{{route('question.create')}}">
                        <i class="fa fa-plus"></i> طراحی سوال
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection
