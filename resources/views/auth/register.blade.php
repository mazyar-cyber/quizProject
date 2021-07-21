<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ثبت نام</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="loginAndRegister/fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="loginAndRegister/css/style.css">
    {{--    bootstrap cdn--}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.esm.min.js"></script>
    {{--    bootstrap cdn--}}
</head>
<body dir="rtl">

<div class="main">

    <!-- Sign up form -->
    <section class="signup">
        <div class="container">
            <div class="signup-content">
                <div class="signup-form">
                    <h2 class="form-title myfont" style="font-size: xx-large">ثبت نام</h2>
                    <form method="POST" action="{{ route('register') }}" class="register-form" id="register-form">
                        @csrf
                        <div class="form-group">
                            <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                            <input type="text" id="name" class="@error('name') is-invalid @enderror"
                                   placeholder="نام و نام خانوادگی" name="name" value="{{ old('name') }}" required
                                   autocomplete="name" autofocus/>
                            @error('name')
                            <span class="form-control bg bg-danger"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email"><i class="zmdi zmdi-email"></i></label>
                            <input type="email" class="@error('email') is-invalid @enderror" name="email" id="email"
                                   placeholder="ایمیل شما" value="{{ old('email') }}" required autocomplete="email"/>
                            @error('email')
                            <span class="form-control bg bg-danger"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="phoneNumber"><i class="zmdi zmdi-phone"></i></label>
                            <input type="number" class="@error('phoneNumber') is-invalid @enderror" name="phoneNumber" id="email"
                                   placeholder="شماره تلفن همراه شما،مثال: 09120000000" value="{{ old('phoneNumber') }}" required autocomplete="phoneNumber"/>
                            @error('phoneNumber')
                            <span class="form-control bg bg-danger"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                            <input type="password" class="@error('password') is-invalid @enderror" id="pass"
                                   placeholder="رمز عبور" name="password" required autocomplete="new-password"/>
                            @error('password')
                            <span class="form-control bg bg-danger"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                            <input type="password" id="re_pass" placeholder="تکرار رمز عبور"
                                   name="password_confirmation" required autocomplete="new-password"/>
                        </div>

                        <div class="form-group form-button">
                            <input type="submit" name="signup" id="signup" class="form-submit" value="Register"/>
                        </div>
                    </form>
                </div>
                <div class="signup-image">
                    <figure><img src="loginAndRegister/images/signup-image.jpg" alt="sing up image"></figure>
                    <a href="/login" class="signup-image-link myfont">عضو هستید؟؟</a>
                </div>
            </div>
        </div>
    </section>


</div>

<!-- JS -->
<script src="loginAndRegister/vendor/jquery/jquery.min.js"></script>
<script src="loginAndRegister/js/main.js"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>
