@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">عوض کردن رمز عبور</div>

                    <div class="card-body">
                        @if (session('phoneNumber-error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('phoneNumber-error') }}
                            </div>
                        @endif

                        @if (session('smsVerificationSuccessful'))
                            <div class="alert alert-success" role="alert">
                                {{ session('smsVerificationSuccessful') }}
                            </div>
                        @endif

                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="/sendingVerificationCode">
                            @csrf

                            <div class="form-group row" dir="rtl">
                                <label for="phoneNumber" class="col-md-4 col-form-label text-md-left">شماره تلفن
                                    شما</label>

                                <div class="col-md-6">
                                    <input id="email" type="number"
                                           class="form-control @error('phoneNumber') is-invalid @enderror"
                                           name="phoneNumber" value="{{ old('phoneNumber') }}" required
                                           autocomplete="phoneNumber" autofocus
                                           placeholder="شماره تلفن را این فرمت وارد کنید: 09120000000">

                                    @error('phoneNumber')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        ارسال رمز عبور جدید
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
