@extends('layouts.app')

@section('content')
    <div class="container" dir="rtl">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                    <div class="card-body">
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ __('A fresh verification link has been sent to your email address.') }}
                            </div>
                        @endif

                        @if (\Illuminate\Support\Facades\Session::has('validation-danger'))
                            <div class="alert alert-danger">
                                {{session('validation-danger')}}
                                احتمالا کد را اشتباه وارد کرده اید
                            </div>
                        @endif


                        <p> یک اس ام اس حاوی یک کد برای شما ارسال شده است لطفا آنرا وارد کنید
                        </p>

                        <form action="{{route('check.sms')}}" method="post">
                            @csrf
                            <input type="number" class="form-control" placeholder="کد ارسال شده را اینجا وارد کنید"
                                   name="code">
                            <input type="submit" class="form-control btn btn-success" value="بررسی">
                        </form>
{{--                        <form class="d-inline" method="POST" action="/">--}}
{{--                            @csrf--}}
{{--                            <button type="submit"--}}
{{--                                    class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>--}}
{{--                        </form>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
