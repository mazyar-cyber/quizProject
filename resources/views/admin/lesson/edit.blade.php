@extends('admin.layouts.master')
@section('context')
    <div class="col-md-9">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"> ویرایش درس <span
                        style="font-weight: bolder">{{\Illuminate\Support\Str::limit($lesson->lesson, 30, '...')}}</span>
                </h3>
                @if (\Illuminate\Support\Facades\Session::has('lesson-edit'))
                    <div class="alert alert-success">
                        {{session('lesson-edit')}}
                    </div>
                @endif
                @if($errors->all())
                    <div class="alert alert-danger">
                        درس شما ویرایش نشد(خطاها را بررسی کنید)
                    </div>
                @endif
                <a class="btn  pull-left" href="{{route('lesson.index')}}">
                    <i class="fa fa-list"></i> لیست درس ها
                </a><br><br>
                <a class="btn btn-app pull-left" href="{{route('lesson.create')}}">
                    <i class="fa fa-plus-square"></i> افزودن
                </a>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" enctype="multipart/form-data"
                  action="{{route('lesson.update',$lesson->id)}}">
                @csrf
                @method('patch')

                <div class="box-body">
                    <div class="form-group">
                        <label>نام درس را میتوانید تغییر دهید</label>
                        <input type="text" name="name" value="{{$lesson->name}}" required>
                    </div>
                </div>

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">ویرایش</button>
                </div>
            </form>
        </div>
    </div>
@endsection
