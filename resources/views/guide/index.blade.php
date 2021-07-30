@extends('admin.layouts.master')
@section('context')
    <div class="col-md-8">
        @if (\Illuminate\Support\Facades\Session::has('access-error'))
            <div class="alert alert-danger">
                {{session('access-error')}}
                <a href="/planShow">برای خرید اشتراک کلیک کنید</a>
            </div>
        @endif

        @if (\Illuminate\Support\Facades\Session::has('validation-Success'))
            <div class="alert alert-success">
                {{session('validation-Success')}}
            </div>
        @endif

        @if (\Illuminate\Support\Facades\Session::has('no-question'))
            <div class="alert alert-warning">
                {{session('no-question')}}
            </div>
        @endif
        @if (\Illuminate\Support\Facades\Session::has('test-not-start'))
            <div class="alert alert-warning">
                {{session('test-not-start')}}
                @include('timerCountDown.index',compact('id'))
            </div>
        @endif

        @if (\Illuminate\Support\Facades\Session::has('spin-error'))
            <div class="alert alert-warning">
                {{session('spin-error')}}
            </div>
        @endif
    </div>
    <div class="col-md-6">
        <div class="box box-default">
            <div class="box-header with-border">
                <i class="fa fa-bullhorn"></i>

                <h3 class="box-title">راهنمای طراح سوال</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

                <div class="callout callout-info">
                    <h4> راهنمایی </h4>
                    <p>
                        {{\App\Models\Guides::latest()->first()->adminGuide}}
                    </p>
                </div>

            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>

    <div class="col-md-6">
        <div class="box box-default">
            <div class="box-header with-border">
                <i class="fa fa-bullhorn"></i>

                <h3 class="box-title">راهنمای دانش آموز(دانشجو)</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

                <div class="callout callout-info">
                    <h4> راهنمایی </h4>
                    <p>
                        {{\App\Models\Guides::latest()->first()->studentGuide}}
                    </p>
                </div>

            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
@endsection
