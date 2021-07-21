@extends('admin.layouts.master')
@section('context')
    @if (\Illuminate\Support\Facades\Session::has('video-edit'))
        <div class="alert alert-warning">
            {{session('video-edit')}}
        </div>
    @endif
    <div class="col-md-9">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"> ویرایش ویدیو
                </h3>
                @if (\Illuminate\Support\Facades\Session::has('video-edit'))
                    <div class="alert alert-success">
                        {{session('video-edit')}}
                    </div>
                @endif
                @if($errors->all())
                    <div class="alert alert-danger">
                        ویدیو شما ویرایش نشد(خطاها را بررسی کنید)
                    </div>
                @endif
                <a class="btn  pull-left" href="{{route('video.index')}}">
                    <i class="fa fa-list"></i> لیست ویدیو ها
                </a><br><br>
                <a class="btn btn-app pull-left" href="{{route('video.create')}}">
                    <i class="fa fa-plus-square"></i> افزودن
                </a>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" enctype="multipart/form-data"
                  action="{{route('video.update',$video->id)}}">
                @csrf
                @method('patch')

                <div class="form-group">
                    <label>عنوان ویدیو را میتوانید تغییر دهید</label>
                    <input type="text" name="title" class="form-control" value="{{$video->title}}">
                </div>

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">ویرایش</button>
                </div>
            </form>
        </div>
    </div>
@endsection
