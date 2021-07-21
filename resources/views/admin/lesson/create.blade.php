@extends('admin.layouts.master')
@section('context')

    <div class="col-md-9">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">ایجاد درس</h3>
                @if (\Illuminate\Support\Facades\Session::has('lesson-save'))
                    <div class="alert alert-success">
                        {{session('lesson-save')}}
                    </div>
                @endif
                @if($errors->all())
                    <div class="alert alert-danger">
                        (خطاها را بررسی کنید)سوال شما ذخیره نشد
                    </div>
                @endif
                <a class="btn  pull-left" href="{{route('lesson.index')}}">
                    <i class="fa fa-list"></i> لیست درس ها
                </a>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" action="{{route('lesson.store')}}">
                @csrf
                <div class="box-body">
                    <div class="form-group">
                        <label>نام درس را بنویسید</label>
                        <input type="text" class="form-control" name="name">
                        @error('name')
                        <span class="alert alert-warning col-md-3">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">ذخیره</button>
                </div>
            </form>
        </div>
    </div>
@endsection
