@extends('admin.layouts.master')
@section('context')
    <div class="col-md-9">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">ویرایش آزمون</h3>
                <h4>تاریخ شروع
                    : {{{\Hekmatinasser\Verta\Facades\Verta::instance($test->startTime)->formatDifference()}}}</h4>
                <h4>تاریخ پایان
                    : {{{\Hekmatinasser\Verta\Facades\Verta::instance($test->endTime)->formatDifference() }}}</h4>
                @if (\Illuminate\Support\Facades\Session::has('test-update'))
                    <div class="alert alert-success">
                        {!!session('test-update') !!}
                    </div>
                @endif
                @if($errors->all())
                    <div class="alert alert-danger">
                        (خطاها را بررسی کنید)آزمون شما ویرایش نشد
                    </div>
                @endif
                <a class="btn  pull-left" href="{{route('test.index')}}">
                    <i class="fa fa-list"></i> لیست آزمون ها
                </a>
                <a class="btn  pull-left" href="/admin/test/{{$test->id}}">
                    <i class="fa fa-list"></i> لیست سوالات مربوط به این آزمون
                </a>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" enctype="multipart/form-data" action="{{route('test.update',$test->id)}}">
                @csrf
                @method('PATCH')
                <div class="box-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">نام آزمون</label>
                        <input type="text" name="name" class="form-control" value="{{$test->name}}">
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>وضعیت</label>
                        <select class="form-control" name="status">
                            <option value="1" @if($test->status==1) selected @endif> فعال</option>
                            <option value="0" @if($test->status==0) selected @endif> غیرفعال</option>
                        </select>
                    </div>


                    <div class="form-group">
                        <label for="exampleInputEmail1">شروع آزمون</label>
                        <input class="form-control" type="datetime-local" name="TestStartTime"
                               value="{{$test->startTime}}" required>
                        @error('TestStartTime')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label for="exampleInputEmail1">پایان آزمون</label>
                        <input class="form-control" type="datetime-local" name="TestEndTime" value="{{$test->endTime}}"
                               required>
                        @error('TestEndTime')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>


                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">ویرایش</button>
                </div>
            </form>
        </div>
    </div>
@endsection
