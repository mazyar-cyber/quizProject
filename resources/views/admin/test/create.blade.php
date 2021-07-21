@extends('admin.layouts.master')
@section('context')
    <div class="col-md-9">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">ایجاد آزمون</h3>
                <div class="alert alert-info">این صفحه را با مرورگر کروم باز کنید</div>
                @if (\Illuminate\Support\Facades\Session::has('test-save'))
                    <div class="alert alert-success">
                        {!!session('test-save') !!}
                    </div>
                @endif
                @if($errors->all())
                    <div class="alert alert-danger">
                        (خطاها را بررسی کنید)آزمون شما ایجاد نشد
                    </div>
                @endif
                <a class="btn  pull-left" href="{{route('test.index')}}">
                    <i class="fa fa-list"></i> لیست آزمون ها
                </a>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" enctype="multipart/form-data" action="{{route('test.store')}}">
                @csrf
                <div class="box-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">نام آزمون</label>
                        <input type="text" name="name" class="form-control">
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>وضعیت</label>
                        <select class="form-control" name="status">
                            <option value="1"> فعال</option>
                            <option value="0"> غیرفعال</option>
                        </select>
                    </div>


                    <div class="form-group">
                        <label for="exampleInputEmail1">شروع آزمون</label>
                        <input class="form-control" type="datetime-local" name="TestStartTime">
                        @error('TestStartTime')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label for="exampleInputEmail1">پایان آزمون</label>
                        <input class="form-control" type="datetime-local" name="TestEndTime">
                        @error('TestEndTime')
                        <div class="alert alert-danger">{{ $message }}</div>
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
