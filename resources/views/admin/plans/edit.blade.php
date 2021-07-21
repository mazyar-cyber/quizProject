@extends('admin.layouts.master')
@section('context')
    <div class="col-md-9">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"> ویرایش طرح <span
                        style="font-weight: bolder">{{$plan->name}}</span>
                </h3>
                @if (\Illuminate\Support\Facades\Session::has('plan-edit'))
                    <div class="alert alert-success">
                        {{session('plan-edit')}}
                    </div>
                @endif
                @if($errors->all())
                    <div class="alert alert-danger">
                        طرح شما ویرایش نشد(خطاها را بررسی کنید)
                    </div>
                @endif
                <a class="btn  pull-left" href="{{route('plan.index')}}">
                    <i class="fa fa-list"></i> لیست طرح ها
                </a><br><br>
                <a class="btn btn-app pull-left" href="{{route('plan.create')}}">
                    <i class="fa fa-plus-square"></i> افزودن
                </a>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" enctype="multipart/form-data"
                  action="{{route('plan.update',$plan->id)}}">
                @csrf
                @method('patch')

                <div class="box-body">
                    <div class="form-group">
                        <label>نام طرح را میتوانید تغییر دهید</label>
                        <input type="text" name="name" class="form-control" value="{{$plan->name}}" required>
                        @error('name')
                        <span class="alert alert-warning col-md-2">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>قیمت طرح را میتوانید تغییر دهید (تومان)</label>
                        <input type="number" name="price" class="form-control" value="{{$plan->price}}" required>
                        @error('price')
                        <span class="alert alert-warning col-md-2">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>زمان اعتبار طرح را میتوانید تغییر دهید</label>
                        <input type="number" name="validityTime" class="form-control" value="{{$plan->validityTime}}" required>
                        @error('validityTime')
                        <span class="alert alert-warning col-md-2">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>توضیحات طرح را میتوانید تغییر دهید</label>
                        <input type="text" class="form-control" name="description" value="{{$plan->description}}" required>
                        @error('description')
                        <span class="alert alert-warning col-md-2">{{$message}}</span>
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
