@extends('admin.layouts.master')
@section('context')
    <section class="content-header">
        <h1>
            صفحه ارور 403
        </h1>
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> خانه</a></li>
            <li class="active">ارور 403</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="error-page">
            <h2 class="headline text-yellow"> 403</h2>

            <div class="error-content">
                <h3><i class="fa fa-warning text-yellow"></i> شما حق دسترسی به این قسمت را ندارید </h3>

                <p>متاسفانه شما حق دسترسی به این صفحه را ندارید چون در نقش دانش آموز وارد شدید میتوانید به <a
                        href="/">خانه</a> برگردید یا آدرس خود را جستجو کنید</p>


            </div>

        </div>

    </section>
@endsection
