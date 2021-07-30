@extends('admin.layouts.master')
@section('context')
    @if (\Illuminate\Support\Facades\Session::has('pdf-edit'))
        <div class="alert alert-warning">
            {{session('pdf-edit')}}
        </div>
    @endif
    <div class="col-md-9">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"> ویرایش پی دی اف
                </h3>
                @if (\Illuminate\Support\Facades\Session::has('pdf-edit'))
                    <div class="alert alert-success">
                        {{session('pdf-edit')}}
                    </div>
                @endif
                @if($errors->all())
                    <div class="alert alert-danger">
                        پی دی اف شما ویرایش نشد(خطاها را بررسی کنید)
                    </div>
                @endif
                <a class="btn  pull-left" href="{{route('pdf.index')}}">
                    <i class="fa fa-list"></i> لیست پی دی اف ها
                </a><br><br>
                <a class="btn btn-app pull-left" href="{{route('pdf.create')}}">
                    <i class="fa fa-plus-square"></i> افزودن
                </a>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" enctype="multipart/form-data"
                  action="{{route('pdf.update',$pdf->id)}}">
                @csrf
                @method('patch')

                <div class="form-group">
                    <label>نام پی دی اف را میتوانید تغییر دهید</label>
                    <input type="text" name="name" class="form-control" value="{{$pdf->name}}">
                </div>

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">ویرایش</button>
                </div>
            </form>
        </div>
    </div>
@endsection
