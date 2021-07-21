@extends('admin.layouts.master')
@section('context')

    <div class="col-md-9">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">آپلود ویدیو</h3>
                @if (\Illuminate\Support\Facades\Session::has('link-save'))
                    <div class="alert alert-success">
                        {{session('link-save')}}
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
                <a class="btn  pull-left" href="{{route('video.link.index')}}">
                    <i class="fa fa-list"></i> لیست لینک ها
                </a>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" action="{{route('video.link.store')}}">
                @csrf
                <div class="box-body">

                    <div class="form-group">
                        <label>عنوان</label>
                        <input type="text" class="form-control" name="title" required>
                        @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>آدرس لینک:</label>
                        <input type="text" class="form-control" name="link" required
                               placeholder="آدرس لینک را اینجا بنویسید،مثال: https://www.example.com">
                        @error('link')
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
