@extends('admin.layouts.master')
@section('context')

    <div class="col-md-9">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">ایجاد کاربر</h3>
                @if (\Illuminate\Support\Facades\Session::has('user-save'))
                    <div class="alert alert-success">
                        {{session('user-save')}}
                    </div>
                @endif
                @if($errors->all())
                    <div class="alert alert-danger">
                        (خطاها را بررسی کنید)کاربر شما ذخیره نشد
                    </div>
                @endif
                <a class="btn  pull-left" href="{{route('user.index')}}">
                    <i class="fa fa-list"></i> لیست کاربر ها
                </a>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" action="{{ route('user.store') }}">
                @csrf
                <div class="box-body">
                    <div class="form-group">
                        <label>نام کاربر را بنویسید</label>
                        <input type="text" name="name" class="form-control" required>
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label>شماره تلفن کاربر را بنوسید (نام کاربری)</label>
                        <input type="number" name="phoneNumber" class="form-control" required>
                        @error('phoneNumber')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label>سطح دسترسی</label>
                        <select name="is_Teacher" class="form-control">
                            <option value="0">کاربر عادی</option>
                            <option value="1">ادمین</option>
                        </select>
                        @error('is_Teacher')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"> رمز عبور:</label>
                        <input type="password" name="password" class="form-control" required>
                        @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-control">
                        <label for="exampleInputEmail1">تکرار رمز عبور:</label><br>
                        <input type="password" class="form-control" placeholder="تکرار رمز عبور"
                               name="password_confirmation" required autocomplete="new-password">
                        @error('password_confirmation')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>


                </div>
                <!-- /.box-body -->
                <br><br><br>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">ذخیره</button>
                </div>
            </form>
        </div>
    </div>
@endsection
