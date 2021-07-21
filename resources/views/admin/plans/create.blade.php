@extends('admin.layouts.master')
@section('context')

    <div class="col-md-9">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">ایجاد پلن(طرح)</h3>
                @if (\Illuminate\Support\Facades\Session::has('plan-save'))
                    <div class="alert alert-success">
                        {{session('plan-save')}}
                    </div>
                @endif
                @if($errors->all())
                    <div class="alert alert-danger">
                        (خطاها را بررسی کنید)طرح شما ذخیره نشد
                    </div>
                @endif
                <a class="btn  pull-left" href="{{route('plan.index')}}">
                    <i class="fa fa-list"></i> لیست طرح ها
                </a>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" action="{{route('plan.store')}}">
                @csrf
                <div class="box-body">
                    <div class="form-group">
                        <label>نام طرح را بنویسید</label>
                        <input type="text" class="form-control" name="name">
                        @error('name')
                        <span class="alert alert-warning col-md-3">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>اعتبار طرح <span style="color: #8a8ad8">(مدت زمانی که امکان دسترسی میدهد(بر حسب روز))</span>
                        </label>
                        <input type="number" class="form-control" name="validityTime">
                        @error('validityTime')
                        <span class="alert alert-warning col-md-3">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>توضیحات طرح: </label>
                        <input type="text" class="form-control" name="description"
                               placeholder="مثال:این طرح به شما امکان دسترسی به به گردونه شانس،ویدیو ها،pdf ها، و شرکت در تمامی سوالات آزمون ها را میدهد">
                        @error('description')
                        <span class="alert alert-warning col-md-3">{{$message}}</span>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label>قیمت طرح(تومان)</label>
                        <input type="number" class="form-control" name="price">
                        @error('price')
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
