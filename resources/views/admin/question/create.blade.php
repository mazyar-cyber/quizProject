@extends('admin.layouts.master')
@section('script')
    <script>
        tinymce.init({
            selector: '#mytextarea',
        });
    </script>
@endsection
@section('context')
    @if (\Illuminate\Support\Facades\Session::has('question-time-error'))
        <div class="alert alert-warning">
            {{session('question-time-error')}}
        </div>
    @endif

    <div class="col-md-9">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">ایجاد سوال</h3>
                @if (\Illuminate\Support\Facades\Session::has('question-save'))
                    <div class="alert alert-success">
                        {{session('question-save')}}
                    </div>
                @endif
                @if($errors->all())
                    <div class="alert alert-danger">
                        (خطاها را بررسی کنید)سوال شما ذخیره نشد
                    </div>
                @endif
                <a class="btn  pull-left" href="{{route('question.index')}}">
                    <i class="fa fa-list"></i> لیست سوال ها
                </a>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" enctype="multipart/form-data" action="{{route('question.store')}}">
                @csrf
                <div class="box-body">
                    <div class="form-group">
                        <label>نام آزمون را تعیین کنید</label>
                        <select class="form-control select2" name="test" style="width: 100%;" required>
                            @foreach($tests as $test)
                                <option value="{{$test->id}}">{{$test->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>این سوال مربوط به چه درسی باشد؟</label>
                        <select class="form-control select2" name="lesson" style="width: 100%;" required>
                            @foreach($lessons as $lesson)
                                <option value="{{$lesson->id}}">{{$lesson->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">صورت سوال</label>
                        <textarea name="question" class="form-control" id="mytextarea"></textarea>
                        @error('question')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label for="exampleInputEmail1">جواب اول</label>
                        <textarea name="answer1" class="form-control" id="mysecoundtextarea"
                                  style="resize: vertical"></textarea>
                        @error('answer1')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"> جواب دوم </label>
                        <textarea name="answer2" class="form-control" id="mythirdtextarea"
                                  style="resize: vertical"></textarea>
                        @error('answer2')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">جواب سوم</label>
                        <textarea name="answer3" class="form-control" id="myfourthtextarea"
                                  style="resize: vertical"></textarea>
                        @error('answer3')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">جواب چهارم</label>
                        <textarea name="answer4" class="form-control" id="myfifthtextarea"
                                  style="resize: vertical"></textarea>
                        @error('answer4')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="exampleInputFile">ارسال عکس برای سوال</label>
                        <input type="file" name="pic" id="exampleInputFile">
                        @error('pic')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="col-md-6">
                        <div class="form-group">
                            <label>جواب صحیح</label>
                            <select class="form-control select2" name="trueAnswer" style="width: 100%;" required>
                                <option value="1">جواب اول</option>
                                <option value="2">جواب دوم</option>
                                <option value="3">جواب سوم</option>
                                <option value="4">جواب چهارم</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>مدت زمان پاسخگویی به این سوال(به دقیقه)</label>
                        <input class="form-group" type="number" name="TimeToAnswer">
                        @error('TimeToAnswer')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputFile"> نمره یا امتیاز سوال را تعیین کنید</label>

                            <select class="form-control select2" name="questionStar" style="width: 100%;" required>
                                @for($i=1;$i<=100;$i++)
                                    <option value='{{$i}}'>{{$i}}</option>
                                @endfor
                            </select>
                        </div>

                    </div>

                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">ذخیره</button>
                </div>
            </form>
        </div>
    </div>
@endsection
