@extends('admin.layouts.master')
@section('context')

    <div class="col-md-9">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">آپلود پی دی  اف</h3>
                @if (\Illuminate\Support\Facades\Session::has('pdf-save'))
                    <div class="alert alert-success">
                        {{session('pdf-save')}}
                    </div>
                @endif
                @if($errors->all())
                    <div class="alert alert-danger">
                        (خطاها را بررسی کنید)پی دی  اف شما ذخیره نشد
                    </div>
                @endif
                <a class="btn  pull-left" href="{{route('pdf.index')}}">
                    <i class="fa fa-list"></i> لیست پی دی  اف ها
                </a>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" enctype="multipart/form-data" action="{{route('pdf.store')}}">
                @csrf
                <div class="box-body">
                    <div class="form-group">
                        <label>عنوان پی دی  اف:</label>
                        <input type="text" class="form-control" name="name" required>
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>پی دی  اف مورد نظر خود را از اینجا آپلود کنید</label>
                        <input type="file" name="file" class="form-control" required>
                        @error('file')
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
