@extends('admin.layouts.master')
@section('context')
    <div class="col-md-9">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"> ویرایش کاربر <span
                        style="font-weight: bolder">{!! $user->name!!}</span>
                </h3>

                @if (\Illuminate\Support\Facades\Session::has('user-edit'))
                    <div class="alert alert-success">
                        {{session('user-edit')}}
                    </div>
                @endif
                @if (\Illuminate\Support\Facades\Session::has('user-update'))
                    <div class="alert alert-success">
                        {{session('user-update')}}
                    </div>
                @endif
                @if($errors->all())
                    <div class="alert alert-danger">
                        کاربر ویرایش نشد(خطاها را بررسی کنید)
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
            <form role="form" method="post" enctype="multipart/form-data"
                  action="{{route('user.update',$user->id)}}">
                @csrf
                @method('patch')

                <div class="form-group">
                    <label>نام کاربر را میتوانید تغییر دهید</label>
                    <input type="text" name="name" class="form-control" value="{{$user->name}}" required>
                    @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>


                <div class="form-group">
                    <label>شماره تلفن کاربر را بنوسید (نام کاربری)</label>
                    <input type="number" name="phoneNumber" class="form-control" value="{{$user->phoneNumber}}"
                           required>
                    @error('phoneNumber')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>


                <div class="form-group">
                    <label>سطح دسترسی</label>
                    <select name="is_Teacher" class="form-control">
                        <option @if($user->is_teacher=='0') selected @endif value="0">کاربر عادی</option>
                        <option @if($user->is_teacher=='1') selected @endif value="1">ادمین</option>
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


                <br><br>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">ویرایش</button>
                </div>
            </form>
        </div>
    </div>
@endsection
