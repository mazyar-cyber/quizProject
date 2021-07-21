@extends('admin.layouts.master')
@section('context')
    <div class="col-md-8">
        @if (\Illuminate\Support\Facades\Session::has('access-error'))
            <div class="alert alert-danger">
                {{session('access-error')}}
                <a href="/planShow">برای خرید اشتراک کلیک کنید</a>
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
                    <p>شما باید ابتدا از قسمت <a href="/admin/test/create">طراحی آزمون</a> یک آزمون ایجاد نمایید و سپس
                        به قسمت
                        <a href="/admin/question/create">طراحی سوال</a> رفته و سوال را را برای آزمون موردنظر ایجاد
                        نمایید</p>
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
                        دانش آموز/دانشجو عزیز شما میتوانید در قسمت شرکت در آزمون در آزمون هایی که تعریف شده اند شرکت
                        کنید و پس از اتمام آزمون موردنظر نتیجه را در قسمت نتایج ببینید
                    </p>
                    <p>
                        در ابتدای ثبت نام شما برای 7 روز دسترسی به تمامی اجزای سایت مقدور میباشد و پس از این مدت برای دسترسی به قسمت های ویدیو ها ،پی دی اف ها،چرخ گردون و دیدن تمام سوالات یک آزمون باید از قسمت های پلن ویژه،طرحی را خریداری بفرمایید
                    </p>
                </div>

            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
@endsection
