<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>داشبرد | کنترل پنل مدیریت</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->

    {{--    spin script and css--}}
    <link rel="stylesheet" href="/js/spin/main.css" type="text/css"/>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script type="text/javascript" src="/js/spin/Winwheel.js"></script>
    <script src="{{asset('/js/spin/TweenMax.min.js')}}"></script>
    {{--    <script src="http://cdnjs.cloudflare.com/ajax/libs/gsap/latest/TweenMax.min.js"></script>--}}
    {{--    spin script and css--}}

    {{--    tiny editor cdn--}}
    {{--    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>--}}
    <script src="{{asset('dist/js/tinymce.min.js')}}"></script>

    {{--    tiny editor cdn--}}

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    @yield('cdn')
    @yield('style')
<!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/basic.min.css"
          integrity="sha512-MeagJSJBgWB9n+Sggsr/vKMRFJWs+OUphiDV7TJiYu+TNQD9RtVJaPDYP8hA/PAjwRnkdvU+NsTncYTKlltgiw=="
          crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/dropzone.min.css"
          integrity="sha512-jU/7UFiaW5UBGODEopEqnbIAHOI8fO6T99m7Tsmqs2gkdujByJfkCbbfPSN4Wlqlb9TGnsuC0YgUgWkRBK7B9A=="
          crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/basic.min.css"
          integrity="sha512-U0/VTgFxv1XpcI4ZrZNgVTV8IxOZBQDuUTRJexBY76M71M1XMV/hntGDZ1TfaAyjyGDVxh3JT5tedRSMHO8ZXg=="
          crossorigin="anonymous"/>
    {{--   dropzone --}}
    <script src="{{asset('js/tinymce.min.js')}}" referrerpolicy="origin"></script>
    {{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/dropzone.min.css"--}}
    {{--          integrity="sha512-jU/7UFiaW5UBGODEopEqnbIAHOI8fO6T99m7Tsmqs2gkdujByJfkCbbfPSN4Wlqlb9TGnsuC0YgUgWkRBK7B9A=="--}}
    {{--          crossorigin="anonymous"/>--}}
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#mytextarea'
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
            integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>


    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="/dist/css/bootstrap-theme.css">

    <!-- Bootstrap rtl -->
    <link rel="stylesheet" href="/dist/css/rtl.css">
    <!-- persian Date Picker -->
    {{--    <link rel="stylesheet" href="/dist/css/persian-datepicker-0.4.5.min">--}}
<!-- Font Awesome -->
    <link rel="stylesheet" href="/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="/bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/dist/css/AdminLTE.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="/dist/css/skins/_all-skins.min.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="/bower_components/morris.js/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="/bower_components/jvectormap/jquery-jvectormap.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="/bower_components/bootstrap-daterangepicker/daterangepicker.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    {{--    toaster--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    {{--toaster--}}

</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="/" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini">پنل</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>کنترل پنل مدیریت</b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>


            {{--            <a href="/logout" class="btn hidden-xs"--}}
            {{--               style="margin:6px 100px;padding:9px 50px;background-color:#d61577;border-color:#ad0b5d;font-weight:bold;color:#FFF">--}}
            {{--                خروج از حساب کاربری</a>--}}


            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- Messages: style can be found in dropdown.less-->
                    <li class="dropdown messages-menu" title="امتیازات شما">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-star-half-o"></i>
                            @if(\App\Models\UserStar::where('user_id',\Illuminate\Support\Facades\Auth::id())->first())
                                <span
                                    class="label label-success">
                                    {{\App\Models\UserStar::where('user_id',\Illuminate\Support\Facades\Auth::id())->first()->TotalScore}}</span>
                            @endif
                        </a>

                    </li>


                    <li class="dropdown notifications-menu">
                        <a href="/spin" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-spinner"></i>
                        </a>
                        <ul class="dropdown-menu">

                            <li class="footer"><a href="/spin">چرخ گردون</a></li>
                        </ul>
                    </li>


                    <li class="dropdown tasks-menu">
                        <a id="myBtn" href="" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="bg-purple-active fa fa-file-video-o"></i>
                        </a>
                        <ul class="dropdown-menu">
                        {{--                            <li class="bg-purple-gradient"><a href="/video">ویدیو ها</a></li>--}}
                        {{--                            <button id="myBtn" class="btn btn-info">آخرین ویدیو</button>--}}


                        @if(\Illuminate\Support\Facades\Auth::user()->is_teacher == '1')
                            <!-- The Modal -->
                                <div id="myModal" class="modal">

                                @if(\App\Models\Links::latest()->first())
                                    <!-- Modal content -->
                                        <div class="modal-content" style="background-color: rgba(27,48,43,0.45)">
                                            <center>
                                        <span class="close"><span class="fa fa-window-close"
                                                                  style="color: darkred"></span></span>

                                                <p>{{\App\Models\Links::latest()->first()->title}}</p>
                                                <video width="720" height="540" autoplay controls>
                                                    <source
                                                        src="{{\App\Models\Links::latest()->first()->link}}">
                                                    Your browser does not support the video tag.
                                                </video>
                                            </center>
                                        </div>
                                </div>
                                <!-- The Modal -->
                        @endif

                        @else
                            @if(\Carbon\Carbon::now()->diffInDays(\Illuminate\Support\Facades\Auth::user()->created_at) <= 7)
                                <!-- The Modal -->
                                    <div id="myModal" class="modal">

                                    @if(\App\Models\Links::latest()->first())
                                        <!-- Modal content -->
                                            <div class="modal-content" style="background-color: rgba(27,48,43,0.45)">
                                                <center>
                                        <span class="close"><span class="fa fa-window-close"
                                                                  style="color: darkred"></span></span>

                                                    <p>{{\App\Models\Links::latest()->first()->title}}</p>
                                                    <video width="720" height="540" autoplay controls>
                                                        <source
                                                            src="{{\App\Models\Links::latest()->first()->link}}">
                                                        Your browser does not support the video tag.
                                                    </video>
                                                </center>
                                            </div>
                                    </div>
                                    <!-- The Modal -->
                                @endif
                                @else
                                    @if(count(\App\Models\UserPlans::where('user_id', \Illuminate\Support\Facades\Auth::id())->get()) == 0)
                                        <div style="color: red;background-color: yellow">شما حق دسترسی به این قسمت را
                                            (بدلیل نداشتن اشتراک)ندارید
                                        </div>
                                    @else
                                        @foreach(\App\Models\UserPlans::where('user_id', \Illuminate\Support\Facades\Auth::id())->get() as $plan)
                                            @if(\Carbon\Carbon::now()->diffInDays($plan->created_at) <= $plan->plan->validityTime)
                                            <!-- The Modal -->
                                                <div id="myModal" class="modal">

                                                    <!-- Modal content -->
                                                    <div class="modal-content"
                                                         style="background-color: rgba(27,48,43,0.45)">
                                                        <center>
                                        <span class="close"><span class="fa fa-window-close"
                                                                  style="color: darkred"></span></span>

                                                            <p>{{\App\Models\Links::latest()->first()->title}}</p>
                                                            <video width="720" height="540" autoplay controls>
                                                                <source
                                                                    src="{{\App\Models\Links::latest()->first()->link}}">
                                                                Your browser does not support the video tag.
                                                            </video>
                                                        </center>
                                                    </div>
                                                </div>
                                                <!-- The Modal -->
                                            @endif
                                        @endforeach
                                        <div style="color: red;background-color: yellow">شما حق دسترسی به این قسمت را
                                            ندارید(بدلیل اتمام اعتبار اشتراک)
                                        </div>
                                    @endif
                                @endif
                            @endif

                        </ul>
                    </li>

                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="/storage/userImage.jpg" class="user-image" alt="User Image">
                            @if(\Illuminate\Support\Facades\Auth::check())
                                <span class="hidden-xs"> {{\Illuminate\Support\Facades\Auth::user()->name}}</span>
                            @endif
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="/storage/userImage.jpg" class="img-circle" alt="User Image">

                                <p>
                                    @if(\Illuminate\Support\Facades\Auth::check())
                                        {{\Illuminate\Support\Facades\Auth::user()->name}}
                                    @endif
                                    <small>مدیریت کل سایت</small>
                                </p>
                            </li>
                            <!-- Menu Body -->
                            <li class="user-body">
                                <div class="row">
                                    <div class="col-xs-4 text-center">
                                        <a href="#" class="message">امتیاز های
                                            شما: @if(\App\Models\UserStar::where('user_id',\Illuminate\Support\Facades\Auth::id())->first())
                                                <span
                                                    class="label label-success">{{\App\Models\UserStar::where('user_id',\Illuminate\Support\Facades\Auth::id())->first()->TotalScore}}</span>
                                            @else 0
                                            @endif</a>
                                    </div>

                                </div>
                                <!-- /.row -->
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-right">
                                    <a href="/profile"
                                       class="btn btn-default btn-flat">پروفایل</a>
                                </div>
                                <div class="pull-left">
                                    <a href="/logout" class="btn btn-default btn-flat">خروج</a>
                                </div>
                            </li>
                        </ul>
                    </li>

                    {{--                    <li class="dropdown">--}}
                    {{--                        <a href="/logout" data-toggle="control-sidebar"><i class="fa fa-power-off"></i></a>--}}
                    {{--                        <ul class="dropdown-menu">--}}

                    {{--                            <li class="footer"><a href="/spin">چرخ گردون</a></li>--}}
                    {{--                        </ul>--}}
                    {{--                    </li>--}}

                </ul>
            </div>
        </nav>
    </header>
    <!-- right side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-right image">
                    <img src="{{asset('storage/userImage.jpg')}}" class="img-circle" alt="User Image">
                </div>
                <div class="pull-right info">
                    @if(\Illuminate\Support\Facades\Auth::check())
                        <p>{{\Illuminate\Support\Facades\Auth::user()->name}}</p>
                    @endif
                    <a href="#"><i class="fa fa-circle text-success"></i> آنلاین</a>
                </div>
            </div>
            <!-- search form -->

            <!-- /.search form -->
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu" data-widget="tree">
                <li class="header">منو</li>

                <li>
                    <a href="{{route('plan.student')}}">
                        <i class="fa fa-money"></i> <span>پلن های ویژه</span>
                        <span class="pull-left-container"></span>
                    </a>
                </li>


                @if(\Illuminate\Support\Facades\Auth::user()->is_teacher==1)

                    <li class="treeview">
                        <a href="#">
                            <i class="fa  fa-question"></i>
                            <span>آزمون</span>
                            <span class="pull-left-container">
              <i class="fa fa-angle-right pull-left"></i>
            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{route('test.create')}}"><i class="fa fa-plus-square"></i> طراحی آزمون</a>
                            </li>
                            <li><a href="{{route('test.index')}}"><i class="fa fa-th-list"></i> لیست آزمون ها
                                </a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa  fa-book"></i>
                            <span>درس ها</span>
                            <span class="pull-left-container">
              <i class="fa fa-angle-right pull-left"></i>
            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{route('lesson.create')}}"><i class="fa fa-plus-square"></i> ایجاد</a>
                            </li>
                            <li><a href="{{route('lesson.index')}}"><i class="fa fa-th-list"></i> لیست درس ها
                                </a></li>
                        </ul>
                    </li>


                    <li class="treeview">
                        <a href="#">
                            <i class="fa  fa-question-circle"></i>
                            <span>سوالات</span>
                            <span class="pull-left-container">
              <i class="fa fa-angle-right pull-left"></i>
            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{route('question.create')}}"><i class="fa fa-plus-square"></i> طراحی سوال</a>
                            </li>
                            <li><a href="{{route('question.index')}}"><i class="fa fa-th-list"></i> لیست سوالات طراحی
                                    شده</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa  fa-user-circle"></i>
                            <span>کاربران</span>
                            <span class="pull-left-container">
              <i class="fa fa-angle-right pull-left"></i>
            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{route('user.create')}}"><i class="fa fa-plus-square"></i> ایجاد کاربر</a>
                            </li>
                            <li><a href="{{route('user.index')}}"><i class="fa fa-th-list"></i> لیست کاربران
                                </a></li>
                        </ul>
                    </li>

                    <li class="treeview">
                        <a href="#">
                            <i class="fa  fa-first-order"></i>
                            <span>تراکنش ها</span>
                            <span class="pull-left-container">
              <i class="fa fa-angle-right pull-left"></i>
            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{route('order.index')}}"><i class="fa fa-th-list"></i> لیست تراکنش ها
                                </a></li>
                        </ul>
                    </li>

                @endif
                <li class="treeview">
                    <a href="#">
                        <i class="fa  fa-question"></i>
                        <span>شرکت در آزمون</span>
                        <span class="pull-left-container">
              <i class="fa fa-angle-right pull-left"></i>
            </span>
                    </a>
                    <ul class="treeview-menu">
                        @foreach($tsts=\App\Models\Tests::where('status','1')->get() as $tst)
                            <li><a href="{{route('result.show',$tst->id)}}"><i class="fa fa-check-square-o"></i>شرکت در
                                    آزمون {{$tst->name}}</a></li>
                        @endforeach
                    </ul>
                </li>

                {{--                <li class="treeview">--}}
                {{--                    <a href="#">--}}
                {{--                        <i class="fa  fa-calendar-check-o"></i>--}}
                {{--                        <span>نتایج آزمون ها</span>--}}
                {{--                        <span class="pull-left-container">--}}
                {{--              <i class="fa fa-angle-right pull-left"></i>--}}
                {{--            </span>--}}
                {{--                    </a>--}}
                {{--                    <ul class="treeview-menu">--}}
                {{--                        @foreach($tsts=\App\Models\Tests::all() as $tst)--}}
                {{--                            <li><a href="{{route('result.show.user',$tst->id)}}"><i class="fa fa-circle-o"></i> نتیجه ی--}}
                {{--                                    آزمون {{$tst->name}}</a></li>--}}
                {{--                        @endforeach--}}
                {{--                    </ul>--}}
                {{--                </li>--}}
                @if(\Illuminate\Support\Facades\Auth::user()->is_teacher==1)
                    <li>
                        <a href="/admin/userStar">
                            <i class="fa fa-star"></i> <span>امتیازات کاربران</span>
                            <span class="pull-left-container"></span>
                        </a>
                    </li>

                    <li>
                        <a href="{{route('testResult')}}">
                            <i class="fa fa-calendar-check-o"></i> <span>نتایج کلی آزمون(برای ادمین)</span>
                            <span class="pull-left-container">
            </span>
                        </a>
                    </li>

                    <li class="treeview">
                        <a href="#">
                            <i class="fa  fa-video-camera"></i>
                            <span>بارگذاری ویدیو</span>
                            <span class="pull-left-container">
              <i class="fa fa-angle-right pull-left"></i>
            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{route('video.create')}}"><i class="fa fa-plus-square"></i> ایجاد ویدیو</a>
                            </li>
                            <li><a href="{{route('video.link.create')}}"><i class="fa fa-plus-square"></i> افزدون
                                    لینک</a>
                            </li>
                            <li><a href="{{route('video.index')}}"><i class="fa fa-th-list"></i> لیست ویدیو ها
                                </a></li>
                            <li><a href="{{route('video.link.index')}}"><i class="fa fa-th-list"></i> لیست لینک ها
                                </a></li>
                        </ul>
                    </li>

                    <li class="treeview">
                        <a href="#">
                            <i class="fa  fa-file-pdf-o"></i>
                            <span>بارگذاری پی دی اف</span>
                            <span class="pull-left-container">
              <i class="fa fa-angle-right pull-left"></i>
            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{route('pdf.create')}}"><i class="fa fa-plus-square"></i> ایجاد </a>
                            </li>
                            <li><a href="{{route('pdf.index')}}"><i class="fa fa-th-list"></i> لیست
                                </a></li>
                        </ul>
                    </li>

                    <li class="treeview">
                        <a href="#">
                            <i class="fa  fa-money"></i>
                            <span>ایجاد پلن های ویژه</span>
                            <span class="pull-left-container">
              <i class="fa fa-angle-right pull-left"></i>
            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{route('plan.create')}}"><i class="fa fa-plus-square"></i> ایجاد پلن</a>
                            </li>
                            <li><a href="{{route('plan.index')}}"><i class="fa fa-list-ol"></i> لیست پلن ها
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
                @if(\Illuminate\Support\Facades\Auth::user()->is_teacher==0)
                    <li>
                        <a href="/spin">
                            <i class="fa fa-spinner"></i> <span>چرخ شانس</span>
                            <span class="pull-left-container"></span>
                        </a>
                    </li>

                    <li>
                        <a href="/video">
                            <i class="fa fa-video-camera"></i> <span>لیست ویدیو ها</span>
                            <span class="pull-left-container"></span>
                        </a>
                    </li>

                    <li>
                        <a href="/pdfStudent">
                            <i class="fa fa-file-pdf-o"></i> <span>لیست pdf ها</span>
                            <span class="pull-left-container"></span>
                        </a>
                    </li>
                @endif
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                داشبرد
                <small>کنترل پنل</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> خانه</a></li>
                <li class="active">داشبرد</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-12 col-xs-10">
                    <!-- small box -->
                    <div class="small-box bg-light-blue-gradient">
                        <div class="inner">
                            <center>
                                <h3>{{count(\App\Models\Tests::where('status','1')->get())}}</h3>

                                <p>آزمون های فعال</p>
                            </center>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
                @if(\Illuminate\Support\Facades\Auth::user()->is_teacher==1)

                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-green">
                            <div class="inner">
                                <h3>{{count(\App\Models\Questions::all())}}</h3>

                                <p>تعداد کل سوالات</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="/admin/question" class="small-box-footer">اطلاعات بیشتر <i
                                    class="fa fa-arrow-circle-left"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-yellow">
                            <div class="inner">
                                <h3>{{count(\App\Models\User::all())}}</h3>

                                <p>کاربران ثبت شده</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <a href="#" class="small-box-footer">اطلاعات بیشتر <i
                                    class="fa fa-arrow-circle-left"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-red">
                            <div class="inner">
                                <h3>{{count(\App\Models\Tests::all())}}</h3>

                                <p> تعداد آزمون ها</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="/admin/test" class="small-box-footer">اطلاعات بیشتر <i
                                    class="fa fa-arrow-circle-left"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-purple">
                            <div class="inner">
                                <h3>{{count(\App\Models\Lessons::all())}}</h3>

                                <p> تعداد درس ها</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="/admin/lesson" class="small-box-footer">اطلاعات بیشتر <i
                                    class="fa fa-arrow-circle-left"></i></a>
                        </div>
                    </div>
                @endif
            </div>
            <!-- /.row -->
            <!-- Main row -->
            <div class="row">

                @yield('context')
            </div>
            <!-- /.row (main row) -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer text-left">
        <strong>طراحی و توسعه داده شده توسط <a
                href="https://msng.link/o/?Ofogherah_Company=tg">افق
                راه</a></strong>
    </footer>

    <!-- Control Sidebar -->

    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>


<!-- jQuery 3 -->
<script src="/bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="/bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="/bower_components/raphael/raphael.min.js"></script>
<script src="/bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="/bower_components/moment/min/moment.min.js"></script>
<script src="/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="/dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/dist/js/demo.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.js"
        integrity="sha512-VQQXLthlZQO00P+uEu4mJ4G4OAgqTtKG1hri56kQY1DtdLeIqhKUp9W/lllDDu3uN3SnUNawpW7lBda8+dSi7w=="
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.18/vue.min.js"></script>
<script>
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the button that opens the modal
    var btn = document.getElementById("myBtn");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks the button, open the modal
    btn.onclick = function () {
        modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function () {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>
<script src="{{asset('js/app.js')}}"></script>
@yield('script')
</body>
</html>
