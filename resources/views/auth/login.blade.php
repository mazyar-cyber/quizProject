<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ورود به پنل مدیریت</title>

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
<body>

<div class="main">

    <!-- Sing in  Form -->
    <section class="sign-in">
        <div class="container">
            <div class="signin-content">
                <div class="signin-image">
                    <figure><img src="loginAndRegister/images/signin-image.jpg" alt="sing up image"></figure>
                    <a href="/register" class="signup-image-link myfont">ثبت نام</a>
                    @if(Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="signup-image-link myfont">رمز عبور را فراموش
                            کرده ام</a>
                    @endif
                </div>

                <div class="signin-form">
                    <h2 class="form-title myfont" style="font-size: xx-large">ورود</h2>
                    <form method="POST" action="{{ route('login') }}" class="register-form" id="login-form">
                        @csrf
                        <div class="form-group">
                            <label for="email"><i class="zmdi zmdi-account material-icons-name"></i></label>
                            <input type="email" name="email" id="your_name" required autofocus
                                   placeholder="ایمیل خود را وارد کنید"/>
                            @error('email')
                            <span class="bg bg-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                            <input type="password" name="password" required autocomplete="current-password"
                                   id="your_pass" placeholder="رمز عبور"
                                   class="@error('password') is-invalid @enderror"/>
                            @error('password')
                            <span class="bg bg-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="remember-me" id="remember-me" class="agree-term"
                                   name="remember"
                                   id="remember" {{ old('remember') ? 'checked' : '' }}/>
                            <label for="remember-me" class="label-agree-term myfont"
                                   style="font-size: 15px"><span><span></span></span>مرا به
                                خاطر بسپار</label>
                        </div>
                        <div class="form-group form-button">
                            <input type="submit" name="signin" id="signin" class="form-submit" value="Log in"/>
                        </div>
                    </form>

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
