@extends('admin.layouts.master')
@section('context')
    @if (\Illuminate\Support\Facades\Session::has('question-time-error'))
        <div class="alert alert-warning">
            {{session('question-time-error')}}
        </div>
    @endif
    <div class="alert alert-warning">حدااکثر حجم ویدیو آپلودشده 38 مگ میتواند باشد</div>
    <div class="col-md-9">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">آپلود ویدیو</h3>
                @if (\Illuminate\Support\Facades\Session::has('video-save'))
                    <div class="alert alert-success">
                        {{session('video-save')}}
                    </div>
                @endif
                @if($errors->all())
                    <div class="alert alert-danger">
                        (خطاها را بررسی کنید)ویدیو شما ذخیره نشد
                    </div>
                @endif
                <a class="btn  pull-left" href="{{route('video.index')}}">
                    <i class="fa fa-list"></i> لیست ویدیو ها
                </a>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" enctype="multipart/form-data" action="{{route('video.store')}}">
                @csrf
                <div class="box-body">
                    <div class="form-group">
                        <label>عنوان ویدیو:</label>
                        <input type="text" class="form-control" name="title" required>
                        @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>ویدیو مورد نظر خود را از اینجا آپلود کنید</label>
                        <input type="file" name="video" class="form-control" required>
                        @error('video')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>


                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">ذخیره</button>
                </div>
            </form>
        </div>
    </div>
@endsection
