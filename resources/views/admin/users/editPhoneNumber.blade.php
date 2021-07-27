@extends('admin.layouts.master')
@section('context')
    <div class="col-md-9">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"> ویرایش شماره تلفن <span
                        style="font-weight: bolder">{!! $user->name!!}</span>
                </h3>

                @if (\Illuminate\Support\Facades\Session::has('user-edit'))
                    <div class="alert alert-success">
                        {{session('user-edit')}}
                    </div>
                @endif
                @if($errors->all())
                    <div class="alert alert-danger">
                        ویرایش نشد(خطاها را بررسی کنید)
                    </div>
                @endif
                <a class="btn  pull-left" href="{{route('user.index')}}">
                    <i class="fa fa-list"></i> لیست کاربر ها
                </a><br><br>
                <a class="btn btn-app pull-left" href="{{route('user.create')}}">
                    <i class="fa fa-plus-square"></i> افزودن
                </a>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post"
                  action="{{route('change.number')}}">
                @csrf
                <div class="form-group">
                    <label>شماره تلفن فعلی خود را بنویسید</label>
                    <input type="number" name="oldPhoneNumber" class="form-control" required>
                    @error('oldPhoneNumber')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1"> شماره تلفن جدید:</label>
                    <input type="number" name="phoneNumber" class="form-control" placeholder="مثال:09220000000"
                           required>
                    @error('phoneNumber')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>


                <br><br>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">ویرایش</button>
                </div>
            </form>
        </div>
    </div>
@endsection
