@extends('admin.layouts.master')

@section('context')

    <div class="col-md-9">

        <div class="alert alert-info">
            آخرین راهنمایی ایجاد شده در صفحه ی اصلی نشان داده خواهد شد
        </div>

        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">نوشتن متن راهنمایی </h3>
                @if (\Illuminate\Support\Facades\Session::has('guide-save'))
                    <div class="alert alert-success">
                        {{session('guide-save')}}
                    </div>
                @endif
                @if($errors->all())
                    <div class="alert alert-danger">
                        (خطاها را بررسی کنید)راهنما شما ذخیره نشد
                    </div>
                @endif

            </div>

            <form role="form" method="post" action="{{route('guide.store')}}">
                @csrf
                <div class="box-body">
                    <div class="form-group">
                        <label>متن راهنمایی student:</label>
                        <textarea class="form-control" id="summernote" name="desc" required></textarea>
                        @error('desc')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>متن راهنمایی admin:</label>
                        <textarea class="form-control" name="desc2" required></textarea>
                        @error('desc2')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="box-footer">
                    <input type="submit" class="btn btn-primary" value="ذخیره">
                </div>
            </form>
        </div>
    </div>
@endsection

