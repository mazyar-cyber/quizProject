@extends('admin.layouts.master')
@section('context')
    <div class="col-xs-12">
        <div class="bg-yellow-gradient">برای دانلود کردن ویدیو روی ویدیو کلیک راست کرده و گزینه ی save video as را کلیک کنید</div>
        <div class="box">
            <center>
                <h2>{{$link->title}}</h2>
                <video width="520" height="440" controls>
                    <source src="{{$link->link}}">
                    Your browser does not support the video tag.
                </video>
                <br>
            </center>
        </div>
    </div>
@endsection
